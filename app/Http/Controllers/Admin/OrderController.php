<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Response;


class OrderController extends Controller
{
    protected $order, $orderdetail;

    public function __construct(Order $order, OrderDetail $orderdetail)
    {
        $this->order = $order;
        $this->order = $orderdetail;
    }

    public function index()
    {
        $orders =  $this->order->latest('id')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request ,$id)
    {
        $order =  $this->order->findOrFail($id);
        $order->update(['status' => $request->status]);
        return  response()->json([
            'message' => 'Success!'
        ], Response::HTTP_OK);

    }

}
