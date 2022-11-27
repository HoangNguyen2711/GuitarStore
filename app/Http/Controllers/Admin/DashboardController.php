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
        $currentDay = Carbon::now()->today();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $yesterday = Carbon::now()->subDay()->day;
        $lastMonth = Carbon::now()->subMonth()->month;
        $lastYear = Carbon::now()->subYear()->year;

        $userCount = $this->user->count();
        $userCountMonth = $this->user->whereMonth('email_verified_at', $currentMonth)->count();
        $userLastMonth = $this->user->whereMonth('email_verified_at', $lastMonth)->count();
        $userToday = $this->user->WhereDay('email_verified_at',$currentDay)->count();
        $userYesterday = $this->user->WhereDay('email_verified_at',$yesterday)->count();
        $userCountYear = $this->user->whereYear('email_verified_at', $currentYear)->count();
        $userLastYear = $this->user->whereYear('email_verified_at', $lastYear)->count();
        
        $orderCount = $this->order->count();
        $orderCountMonth = $this->order->whereMonth('created_at', $currentMonth)->count();
        $orderLastMonth = $this->order->whereMonth('created_at', $lastMonth)->count();
        $orderToday = $this->order->WhereDay('created_at',$currentDay)->count();
        $orderYesterday = $this->order->WhereDay('created_at',$yesterday)->count();
        $orderCountYear = $this->order->whereYear('created_at', $currentYear)->count();
        $orderLastYear = $this->order->whereYear('created_at', $lastYear)->count();

        $productCount = $this->product->count();
        $productCountMonth = $this->product->whereMonth('created_at', $currentMonth)->count();
        $productLastMonth = $this->product->whereMonth('created_at', $lastMonth)->count();
        $productToday = $this->product->WhereDay('created_at',$currentDay)->count();
        $productYesterday = $this->product->WhereDay('created_at',$yesterday)->count();
        $productCountYear = $this->product->whereYear('created_at', $currentYear)->count();
        $productLastYear = $this->product->whereYear('created_at', $lastYear)->count();

        $moneyCount = $this->order->sum('total');
        $moneyCountMonth = $this->order->whereMonth('created_at', $currentMonth)->sum('total');
        $moneyLastMonth = $this->order->whereMonth('created_at', $lastMonth)->sum('total');
        $moneyToday = $this->order->WhereDay('created_at',$currentDay)->sum('total');
        $moneyYesterday = $this->order->WhereDay('created_at',$yesterday)->sum('total');
        $moneyCountYear = $this->order->whereYear('created_at', $currentYear)->sum('total');
        $moneyLastYear = $this->order->whereYear('created_at', $lastYear)->sum('total');

        return view('admin.dashboard.index', compact('userCount', 'productCount', 'orderCount', 'moneyCount',
        'userCountMonth','userLastMonth','userToday','userYesterday','userCountYear','userLastYear',
        'orderCountMonth','orderLastMonth','orderToday','orderYesterday','orderCountYear','orderLastYear',
        'productCountMonth','productLastMonth','productToday','productYesterday','productCountYear','productLastYear',
        'moneyCountMonth','moneyLastMonth','moneyToday','moneyYesterday','moneyCountYear','moneyLastYear'));
    }
}

