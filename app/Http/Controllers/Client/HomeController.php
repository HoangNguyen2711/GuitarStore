<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $product, $order;
    public function __construct(Product $product, Order $order)
    {
        $this->product = $product;
        $this->order = $order;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products =  $this->product->latest('id')->paginate(10);
        $promoProducts =  $this->product->where('sale', '>', '0')->orderBy('sale', 'DESC')->paginate(4);
        //$totalQuantity =  $this->order->select('product_name', 'quantity')->groupBy('product_name')->get(4);
        //var_dump($totalQuantity);

        //select from product where product_name=====
        //count product dua tren product_name
        //order quantity desc,
        //get 3-4 quanity;
        //map product tale
        // SELECT product_name
        // ,SUM(quantity) AS Total_Quantity
        // FROM orders
        // GROUP BY product_name
               
               
       

        
        //lay product_name tu model order, lay thong tin tu bang product where product_name = productname trong bang order
        return view('client.home.index', compact('products','promoProducts'));
    }

    public function shop()
    {
        $products =  $this->product->latest('id')->paginate(8);

        return view('client.home.shop', compact('products'));
    }

    public function search(Request $request)
    {
        $keyword = $request->keywords_submit;
      
        $search = $this->product->where('name', 'like', '%'.$keyword.'%')->get();

        return view('client.products.search', compact('search'));
    }

}
