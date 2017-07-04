<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\Product;
use Carbon\Carbon;
use App\Mylibs\Mylibs;
use DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  $countOrder = Order::whereYear('created_at', '=', date('Y-m-d'))
        // ->whereMonth('created_at', '=', date('m'))->count();
        // dd($countOrder);
        $countOrder = Order::whereDate('created_at', '=', date('Y-m-d'))->count();
        $sumNumber = Order::whereDate('created_at', '=', date('Y-m-d'))->sum('sumnumber');
        $sumTotalPrice = Order::whereDate('created_at', '=', date('Y-m-d'))->sum('totalprice');
        $countUser = User::whereDate('created_at', '=', date('Y-m-d'))->count();
        $orderLasts = Order::whereDate('created_at', '=', date('Y-m-d'))->orderBy('created_at', 'desc')->limit(5)->get();
        foreach ($orderLasts  as $key => $order) {
            $order->created_at = Mylibs::dateToView($order->created_at);
        }
        $productBases= Order::select('product.code', 'product.name', 'product.price', DB::raw('sum(order_detail.number) AS number'))
        ->join('order_detail', 'order.id', '=', 'order_detail.order_id')
        ->join('product', 'order_detail.product_id', '=', 'product.id')
        ->whereDate('order.created_at', '=', date('Y-m-d'))
        ->groupBy('product.code', 'product.name', 'product.price')
        ->orderBy('number', 'desc')
        ->limit(5)
        ->get();

        $products = Product::orderBy('category_id','asc')
        ->orderBy('balance','asc')
        ->limit(5)
        ->get();
        foreach ($products as $key => $product) {
            if($product->balance > $product->balance_check){
                unset($products[$key]);
            }
        }

        // $sumPriceByCategorys= Order::select('category.id', 'category.name', DB::raw('sum(order_detail.number * order_detail.price) as sale'))     //, DB::raw('sum(order_detail.number) AS number')
        // ->join('order_detail', 'order.id', '=', 'order_detail.order_id')
        // ->join('product', 'order_detail.product_id', '=', 'product.id')
        // ->join('category', 'product.category_id', '=', 'category.id')
        // ->whereDate('order.created_at', '=', date('Y-m-d'))
        // ->groupBy('category.id', 'category.name')
        // //->orderBy('number', 'desc')->limit(5)
        // ->get();
        // $totalSale = 0;
        // foreach ($sumPriceByCategorys  as $key => $sumPriceByCategory) {
        //     $totalSale += $sumPriceByCategory->sale;
        // }
        // foreach ($sumPriceByCategorys  as $key => $sumPriceByCategory) {
        //     $sumPriceByCategory['percent'] = number_format(($sumPriceByCategory->sale * 100) / $totalSale);
        // }
        return view('dashboard.index', compact('countOrder', 'sumNumber', 'sumTotalPrice', 'countUser', 'orderLasts', 'productBases', 'products'));
    }

    // public function admin(){
    //     if (auth()->user()->usertype == 2 );

    // }
}
