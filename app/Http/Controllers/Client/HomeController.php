<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $product;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $products = $this->product->latest('id')->paginate(8);
        return view('client.home.index', compact('products'));
    }

    public function shop()
    {
        $products = $this->product->latest()->paginate(5);
        return view('client.layouts.shop', compact('products'));
    }   
}
