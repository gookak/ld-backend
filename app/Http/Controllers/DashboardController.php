<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
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
        $countOrder = Order::whereDate('created_at', '=', date('Y-m-d'))->count();
        $sumNumber = Order::whereDate('created_at', '=', date('Y-m-d'))->sum('sumnumber');
        $sumTotalPrice = Order::whereDate('created_at', '=', date('Y-m-d'))->sum('totalprice');
        $countUser = User::whereDate('created_at', '=', date('Y-m-d'))->count();

        $orderLasts = Order::whereDate('created_at', '=', date('Y-m-d'))->orderBy('created_at', 'desc')->limit(5)->get();
        foreach ($orderLasts  as $key => $order) {
            $order->created_at = Mylibs::dateToView($order->created_at);
        }


        return view('dashboard.index', compact('countOrder', 'sumNumber', 'sumTotalPrice', 'countUser', 'orderLasts'));
    }

    // public function admin(){
    //     if (auth()->user()->usertype == 2 );

    // }
}
