<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\CreateOrderRequest;
use App\Http\Resources\Cart\CartResource;
use App\Jobs\SendEmail;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = $this->cart->firtOrCreateBy(auth()->user()->id)->load('products');

        return view('client.carts.index', compact('cart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $product = $this->product->findOrFail($request->product_id);
            $cart = $this->cart->firtOrCreateBy(auth()->user()->id);
            $cartProduct = $this->cartProduct->getBy($cart->id, $product->id);
            if ($cartProduct) {
                $quantity = $cartProduct->product_quantity;
                $cartProduct->update(['product_quantity' => ($quantity + $request->product_quantity)]);
            } else {
                $dataCreate['cart_id'] = $cart->id;
                $dataCreate['product_quantity'] = $request->product_quantity ?? 1;
                $dataCreate['product_price'] = $product->price;
                $dataCreate['product_id'] = $request->product_id;
                $this->cartProduct->create($dataCreate);
            }
            return back()->with(['message' => 'Added!']);
        }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function removeProductInCart($id)
    {
        $cartProduct =  $this->cartProduct->find($id);
        $cartProduct->delete();
        $cart =  $cartProduct->cart;
        return response()->json([
            'product_cart_id' => $id,
            'cart' => new CartResource($cart)
        ], Response::HTTP_OK);
    }



    public function updateQuantityProduct(Request $request, $id)
    {
        $cartProduct =  $this->cartProduct->find($id);
        $dataUpdate = $request->all();
        if ($dataUpdate['product_quantity'] < 1) {
            $cartProduct->delete();
        }
        // elseif($dataUpdate['product_quantity'] > $cartProduct->quantity) {

        // }
        else {
            $cartProduct->update($dataUpdate);
        }

        $cart =  $cartProduct->cart;

        return response()->json([
            'product_cart_id' => $id,
            'cart' => new CartResource($cart),
            'remove_product' => $dataUpdate['product_quantity'] < 1,
            'cart_product_price' => $cartProduct->total_price
        ], Response::HTTP_OK);
    }

    public function applyCoupon(Request $request)
    {

        $name = $request->input('coupon_code');

        $coupon =  $this->coupon->firstWithExperyDate($name, auth()->user()->id);

        if ($coupon) {
            $message = 'Apply coupon sucessfully!';
            Session::put('coupon_id', $coupon->id);
            Session::put('discount_amount_price', $coupon->vale);
            Session::put('coupon_code', $coupon->name);
        } else {

            Session::forget(['coupon_id', 'discount_amount_price', 'coupon_code']);
            $message = 'Coupon does not exist or has expired!';
        }

        return redirect()->route('client.carts.index')->with([
            'message' => $message,
        ]);
    }

    public function checkout()
    {
        $cart = $this->cart->firtOrCreateBy(auth()->user()->id)->load('products');
        $user = $this->user->find(auth()->user()->id);

        return view('client.carts.checkout', compact('cart','user'));
    }

    public function processCheckout(CreateOrderRequest $request)
    {
        $dataCreate = $request->all();
        $dataCreate['user_id'] = auth()->user()->id;
        $dataCreate['status'] = 'Pending';
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
        
        // $cart = $this->cart->firtOrCreateBy(auth()->user()->id)->load('products');

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


        return view('client.orders.index', compact('orders'));
    }

    public function vnpay()
    {

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "https://www.google.com/";
        $vnp_TmnCode = "TH87NPJF"; //M?? website t???i VNPAY 
        $vnp_HashSecret = "LAAWGIZHDDZCTRWPKISCPCNIYNHJOSHI"; //Chu???i b?? m???t

        $vnp_TxnRef = '6'; //M?? ????n h??ng. Trong th???c t??? Merchant c???n insert ????n h??ng v??o DB v?? g???i m?? n??y sang VNPAY
        $vnp_OrderInfo = 'test payment';
        $vnp_OrderType = 'bill payment';
        $vnp_Amount = 10000 * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }
}
