<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $product, $order, $orderdetail;
    public function __construct(Product $product, Order $order, OrderDetail $orderdetail)
    {
        $this->product = $product;
        $this->order = $order;
        $this->orderdetail = $orderdetail;
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
        
        $totalQuantity =  $this->orderdetail->with('product')->selectRaw('product_id, SUM(quantity) as total_quantity')->groupBy('product_id')->get();
        
        
        // var_dump($totalQuantity);

        //select from product where product_id=====
        //count product dua tren product_id
        //order quantity desc,
        //get 3-4 quanity;
        //map product tale
        // SELECT product_name
        // ,SUM(quantity) AS Total_Quantity
        // FROM orders
        // GROUP BY product_name
               
               
       

        
        //lay product_name tu model order, lay thong tin tu bang product where product_name = productname trong bang order
        return view('client.home.index', compact('products','promoProducts','totalQuantity'));
    }

    public function shop()
    {

        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];

            if($sort_by=='az'){
                $products = $this->product->orderBy('name','asc')->paginate(8)->appends(request()->query());
            }
            elseif($sort_by=='za'){
                $products = $this->product->orderBy('name','desc')->paginate(8)->appends(request()->query());
            }
            elseif($sort_by=='asc'){
                $products = $this->product->orderBy('price','asc')->paginate(8)->appends(request()->query());
            }
            elseif($sort_by=='desc'){
                $products = $this->product->orderBy('price','desc')->paginate(8)->appends(request()->query());
            }
            elseif($sort_by=='sale'){
                $products = $this->product->where('sale', '>',0)->orderBy('sale','desc')->paginate(8)->appends(request()->query());
            }
            elseif($sort_by=='500'){
                $products = $this->product->whereBetween('price', [0, 499])->orderBy('price','asc')->paginate(8)->appends(request()->query());
            }
            elseif($sort_by=='1k'){
                $products = $this->product->whereBetween('price', [500, 999])->orderBy('price','asc')->paginate(8)->appends(request()->query());
            }
            elseif($sort_by=='1k5'){
                $products = $this->product->whereBetween('price', [1000, 1499])->orderBy('price','asc')->paginate(8)->appends(request()->query());
            }
            elseif($sort_by=='2k'){
                $products = $this->product->whereBetween('price', [1500, 1999])->orderBy('price','asc')->paginate(8)->appends(request()->query());
            }
            elseif($sort_by=='2kmore'){
                $products = $this->product->where('price', '>', '1999')->orderBy('price','asc')->paginate(8)->appends(request()->query());
            }
        }
        else{
            $products =  $this->product->latest('id')->paginate(8);
        }

        return view('client.home.shop', compact('products'));
        
    }

    public function search(Request $request)
    {
        $keyword = $request->keywords_submit;
      
        $search = $this->product->where('name', 'like', '%'.$keyword.'%')->get();

        return view('client.products.search', compact('search'));
    }

}
