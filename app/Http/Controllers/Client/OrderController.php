<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;

class OrderController extends Controller
{


    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function index()
    {
        $orders =  $this->order->getWithPaginateBy(auth()->user()->id);
        return view('client.orders.index', compact('orders'));
    }

    public function cancel($id)
    {
        $order =  $this->order->findOrFail($id);
        $order->update(['status' => 'Cancel']);
        return redirect()->route('client.orders.index')->with(['message' => 'Cancelled!']);
    }

    //Lê Bảo Cường
    public function review(Request $request)
    {
        $request->validate([
            'rate' => 'required|numeric|min:1|max:5',
        ]);

        $product = Product::find($request->product_id);
        $product->rate($request->rate, $request->comment);
        
        OrderDetail::where([
            ['product_id', $request->product_id],
            ['order_id', $request->order_id]
        ])->update([
            'review_flag' => true,
        ]);

        return redirect()->route('client.orders.index')->with(['message' => 'Review Added!']);
    }
}
