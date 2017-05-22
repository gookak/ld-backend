<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
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
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $countOrder = Order::where('user_id', 1)->count();



        $countOrder = Order::whereDate('created_at', Carbon::now())->get();

        // $countOrder = Order::where('created_at', '=', date("Y-m-d"))
        // ->orWhereNull('created_at')->count();

        dd($countOrder);

        //$max = Order::where('active', 1)->max('price');
        // return view('dashboard.index', compact('countOrder'));
    }

    // public function admin(){
    //     if (auth()->user()->usertype == 2 );

    // }
}
