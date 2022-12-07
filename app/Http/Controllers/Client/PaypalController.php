<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\CreateOrderRequest;
use App\Jobs\SendEmail;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    /**
     * create transaction.
     *
     * @return \Illuminate\Http\Response
     */
    protected $cart;
    protected $product;
    protected $cartProduct;
    protected $coupon;
    protected $order;
    protected $user;
    protected $orderDetail;

    public function __construct(Product $product, Cart $cart, CartProduct $cartProduct, Coupon $coupon, Order $order, User $user, OrderDetail $orderDetail)
    {
        $this->product = $product;
        $this->cart = $cart;
        $this->cartProduct = $cartProduct;
        $this->coupon = $coupon;
        $this->order = $order;
        $this->user = $user;
        $this->orderDetail = $orderDetail;
    }

    public function createTransaction()
    {
        $orders =  $this->order->getWithPaginateBy(auth()->user()->id);
        return view('client.orders.index', compact('orders'));
    }

    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction(CreateOrderRequest $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
          
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "1000.00"
                    ]
                ]
            ]
        ]);
        
        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('createTransaction')
                ->with('error', 'Something went wrong.');

        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {
 
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $dataCreate = $request->all();
            $dataCreate['user_id'] = auth()->user()->id;
            $dataCreate['status'] = 'Accept';
            $order = $this->order->create($dataCreate);
    
            $cart = $this->cart->firtOrCreateBy(auth()->user()->id)->load('products');
            $productArr = $cart->products->pluck('product_id');
            $quantityArr = $cart->products->pluck('product_quantity');
            for ($i = 0; $i < count($productArr); $i++) {
                if (isset($productArr[$i])) {
                    $order->products()->attach($productArr[$i], ['quantity' => $quantityArr[$i]]);
                    $minus = $this->product->where('id', $productArr[$i])->first();
                    $minus->quantity = $minus->quantity - $quantityArr[$i];
                    $minus->save();
                }
            }
    
            $couponID = Session::get('coupon_id');
            if ($couponID) {
                $coupon =  $this->coupon->find(Session::get('coupon_id'));
                if ($coupon) {
                    $coupon->users()->attach(auth()->user()->id, ['value' => $coupon->vale]);
                }
            }
    
            $info = $this->cartProduct->with('product')->where('cart_id', $cart->id)->get();
            $users = $this->user->find(auth()->user()->id);
            $message = [
                'order'=> $order,
                'cart' => $cart,
            ];
            SendEmail::dispatch($message, $users)->delay(now()->addMinute(1));
    
            $cart->products()->delete();
            Session::forget(['coupon_id', 'discount_amount_price', 'coupon_code']);
            $orders =  $this->order->getWithPaginateBy(auth()->user()->id);
           
            return redirect()
                ->route('createTransaction')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('createTransaction')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}