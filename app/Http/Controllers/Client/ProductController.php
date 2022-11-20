<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
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

    public function index(Request $request, $category_id)
    {
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];

            if($sort_by=='az'){
                $products = $this->product->getBy($request->all(), $category_id)->orderBy('name','asc')->paginate(8)->appends(request()->query());
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
            $products =  $this->product->getBy($request->all(), $category_id);
        }
        return view('client.products.index', compact('products'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->product->findOrFail($id);

        return view('client.products.detail', compact('product'));
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
}
