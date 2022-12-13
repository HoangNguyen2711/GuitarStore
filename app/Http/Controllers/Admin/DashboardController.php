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
        $this->orderdetail = $orderdetail;
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
        $userToday = $this->user->WhereDay('email_verified_at', $currentDay)->count();
        $userYesterday = $this->user->WhereDay('email_verified_at', $yesterday)->count();
        $userCountYear = $this->user->whereYear('email_verified_at', $currentYear)->count();
        $userLastYear = $this->user->whereYear('email_verified_at', $lastYear)->count();

        $orderCount = $this->order->count();
        $orderCountMonth = $this->order->whereMonth('created_at', $currentMonth)->count();
        $orderLastMonth = $this->order->whereMonth('created_at', $lastMonth)->count();
        $orderToday = $this->order->WhereDay('created_at', $currentDay)->count();
        $orderYesterday = $this->order->WhereDay('created_at', $yesterday)->count();
        $orderCountYear = $this->order->whereYear('created_at', $currentYear)->count();
        $orderLastYear = $this->order->whereYear('created_at', $lastYear)->count();

        $productCount = $this->product->count();
        $productCountMonth = $this->product->whereMonth('created_at', $currentMonth)->count();
        $productLastMonth = $this->product->whereMonth('created_at', $lastMonth)->count();
        $productToday = $this->product->WhereDay('created_at', $currentDay)->count();
        $productYesterday = $this->product->WhereDay('created_at', $yesterday)->count();
        $productCountYear = $this->product->whereYear('created_at', $currentYear)->count();
        $productLastYear = $this->product->whereYear('created_at', $lastYear)->count();

        $moneyCount = $this->order->sum('total');
        $moneyCountMonth = $this->order->whereMonth('created_at', $currentMonth)->sum('total');
        $moneyLastMonth = $this->order->whereMonth('created_at', $lastMonth)->sum('total');
        $moneyToday = $this->order->WhereDay('created_at', $currentDay)->sum('total');
        $moneyYesterday = $this->order->WhereDay('created_at', $yesterday)->sum('total');
        $moneyCountYear = $this->order->whereYear('created_at', $currentYear)->sum('total');
        $moneyLastYear = $this->order->whereYear('created_at', $lastYear)->sum('total');

        $products = $this->product->select('id', 'name')->get();
        
        $record = DB::select('select pd.name, SUM(odd.quantity) as qty
        from orders od join order_details odd on od.id = odd.order_id join products pd on odd.product_id = pd.id 
        WHERE od.created_at LIKE :date 
        group by odd.product_id, pd.name', ['date' => $currentDay->toDateString(). '%']);

        $label = [];
        foreach ($record as $d) {
            array_push($label, $d->name);
        }

        $qty = [];
        foreach ($record as $d) {
            array_push($qty, $d->qty);
        }

        return view('admin.dashboard.index', compact(
            'userCount',
            'productCount',
            'orderCount',
            'moneyCount',
            'userCountMonth',
            'userLastMonth',
            'userToday',
            'userYesterday',
            'userCountYear',
            'userLastYear',
            'orderCountMonth',
            'orderLastMonth',
            'orderToday',
            'orderYesterday',
            'orderCountYear',
            'orderLastYear',
            'productCountMonth',
            'productLastMonth',
            'productToday',
            'productYesterday',
            'productCountYear',
            'productLastYear',
            'moneyCountMonth',
            'moneyLastMonth',
            'moneyToday',
            'moneyYesterday',
            'moneyCountYear',
            'moneyLastYear',
            'products',
            'label',
            'qty',
            'currentDay'
        ));
    }

    public function getQtyProductByMonth($product_id, $start_date, $end_date)
    {
        $data = DB::select('select
        odd.product_id
        ,sum(odd.quantity) as qty
        ,pr.name
        from orders od
        join order_details odd on odd.order_id = od.id
        join products pr on odd.product_id = pr.id
        where od.created_at between :start_date and :end_date and odd.product_id = :product_id
        group by odd.product_id,pr.name', ['product_id' => $product_id, 'start_date' => $start_date, 'end_date' => $end_date]);

        if (count($data) > 0) {
            return $data[0]->qty;
        } else {
            return 0;
        }
    }

    public function getProduct(Request $request) {
        $id = $request->id;

        $dataArr = [];
        $janData = $this->getQtyProductByMonth($id, '2022-1-1', '2022-1-31');
        $febData = $this->getQtyProductByMonth($id, '2022-2-1', '2022-2-28');
        $marData = $this->getQtyProductByMonth($id, '2022-3-1', '2022-3-31');
        $aprData = $this->getQtyProductByMonth($id, '2022-4-1', '2022-4-30');
        $mayData = $this->getQtyProductByMonth($id, '2022-5-1', '2022-5-31');
        $junData = $this->getQtyProductByMonth($id, '2022-6-1', '2022-6-30');
        $julData = $this->getQtyProductByMonth($id, '2022-7-1', '2022-7-31');
        $augData = $this->getQtyProductByMonth($id, '2022-8-1', '2022-8-31');
        $sepData = $this->getQtyProductByMonth($id, '2022-9-1', '2022-9-30');
        $octData = $this->getQtyProductByMonth($id, '2022-10-1', '2022-10-31');
        $novData = $this->getQtyProductByMonth($id, '2022-11-1', '2022-11-30');
        $decData = $this->getQtyProductByMonth($id, '2022-12-1', '2022-12-31');
        array_push($dataArr, $janData, $febData, $marData, $aprData, $mayData, $junData, $julData, $augData, $sepData, $octData, $novData, $decData);
        
        return response()->json([
            'success' => true,
            'dataArr' => $dataArr,
        ]);

    }

    
    public function dayChart(Request $request){
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;

        $record = DB::select('select pd.name, SUM(odd.quantity) as qty
        from orders od join order_details odd on od.id = odd.order_id join products pd on odd.product_id = pd.id 
        WHERE od.created_at between :from_date and :to_date 
        group by odd.product_id, pd.name', ['from_date' => $fromDate, 'to_date' => $toDate]);

        $label = [];
        foreach ($record as $d) {
            array_push($label, $d->name);
        }

        $qty = [];
        foreach ($record as $d) {
            array_push($qty, $d->qty);
        }

        return response()->json([
            'success' => true,
            'label' => $label,
            'qty' => $qty,
        ]);
    }
}
