<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    protected $user;
    protected $category;
    protected $order;
    protected $product;
    protected $coupon;
    protected $role;
    protected $orderdetail;

    public function __construct(User $user, Category $category, Order $order, Product $product, Coupon $coupon, Role $role, OrderDetail $orderdetail)
    {
        $this->user = $user;
        $this->category = $category;
        $this->order = $order;
        $this->product = $product;
        $this->coupon = $coupon;
        $this->role = $role;
        $this->orderdetail= $orderdetail;
    }

    public function index()
    {
        // $range = Carbon::now()->subYear(5);
        // $orderYear = DB::table('orders')
        //             ->select(DB::raw('year(date_order) as getYear'), DB::raw('COUNT(*) as value'))
        //             ->where('date_order', '>=', $range)
        //             ->groupBy('getYear')
        //             ->orderBy('getYear', 'ASC')
        //             ->get();
                    
        $userCount = $this->user->count();
        $categoryCount = $this->category->count();
        $orderCount = $this->order->count();
        $productCount = $this->product->count();
        $couponCount = $this->coupon->count();
        $roleCount = $this->role->count();
        $orderPending = $this->order->where('status','Pending')->latest('id')->paginate(5);
        return view('admin.dashboard.index', compact('userCount', 'categoryCount', 'productCount', 'orderCount', 'couponCount', 'roleCount','orderPending'));
    }
}

