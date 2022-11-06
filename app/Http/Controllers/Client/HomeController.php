<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products =  $this->product->latest('id')->paginate(10);

        return view('client.home.index', compact('products'));
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
