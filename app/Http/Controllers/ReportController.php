<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Mylibs\Mylibs;
use App\Order;
use App\User;
use App\Category;
use App\Report;
use mPDF;


class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('admin');
    }

    public function index()
    {
        $reportList = Report::pluck('name', 'url')->toArray();
        $monthList = Mylibs::getMonthList();
        $yearList = Mylibs::getYearList();
        return view('report.index', compact('reportList', 'monthList', 'yearList'));


        //  $countOrder = Order::whereYear('created_at', '=', date('Y-m-d'))
        // ->whereMonth('created_at', '=', date('m'))->count();
        // dd($countOrder);
        // $countOrder = Order::whereDate('created_at', '=', date('Y-m-d'))->count();
        // $sumNumber = Order::whereDate('created_at', '=', date('Y-m-d'))->sum('sumnumber');
        // $sumTotalPrice = Order::whereDate('created_at', '=', date('Y-m-d'))->sum('totalprice');
        // $countUser = User::whereDate('created_at', '=', date('Y-m-d'))->count();
        // $orderLasts = Order::whereDate('created_at', '=', date('Y-m-d'))->orderBy('created_at', 'desc')->limit(5)->get();
        // foreach ($orderLasts  as $key => $order) {
        //     $order->created_at = Mylibs::dateToView($order->created_at);
        // }
        // $productBases= Order::select('product.code', 'product.name', 'product.price', DB::raw('sum(order_detail.number) AS number'))
        // ->join('order_detail', 'order.id', '=', 'order_detail.order_id')
        // ->join('product', 'order_detail.product_id', '=', 'product.id')
        // ->whereDate('order.created_at', '=', date('Y-m-d'))
        // ->groupBy('product.code', 'product.name', 'product.price')
        // ->orderBy('number', 'desc')->limit(5)
        // ->get();

    }

    public function salesbycategory(Request $request)
    {
        // dd($request->all());
        $val = $request->all();

        $report = Report::where('url', $val['report_url'])->first();
        $report['year'] = $val['year'] + 543;
        $report['month'] = Mylibs::getMonthName($val['month']);

        $orders = Order::select('category.name', DB::raw('sum(order_detail.number) AS sumnumber'), DB::raw('sum(order_detail.price) AS sumprice') )
        ->join('order_detail', 'order.id', '=', 'order_detail.order_id')
        ->join('product', 'order_detail.product_id', '=', 'product.id')
        ->join('category', 'product.category_id', '=', 'category.id')
        ->whereMonth('order.created_at', '=', $val['month'])
        ->whereYear('order.created_at', '=', $val['year'])
        ->orderBy('sumnumber', 'desc')
        ->orderBy('sumprice', 'desc')
        ->get();

        $filename = $report->name.'_'.$report->year.'_'.$report->month.'.pdf';
        $html = view('report.pdf_salesbycategory', compact('orders', 'report'))->render();
        $mpdf = new mPDF('th', 'A4');
        $mpdf->WriteHTML(file_get_contents('css/pdf.css'),1);
        $mpdf->WriteHTML($html,2);
        $mpdf->SetTitle($filename);
        $mpdf->Output();
        // return view('report.pdf_salesbycategory', compact('orders', 'report'));
    }

    public function salesbyproduct(Request $request)
    {
        // dd($request->all());
        $val = $request->all();

        $report = Report::where('url', $val['report_url'])->first();
        $report['year'] = $val['year'] + 543;
        $report['month'] = Mylibs::getMonthName($val['month']);

        $orders = Order::select('product.code', 'product.name', 'product.price', DB::raw('sum(order_detail.number) AS sumnumber'), DB::raw('sum(order_detail.price) AS sumprice') )
        ->join('order_detail', 'order.id', '=', 'order_detail.order_id')
        ->join('product', 'order_detail.product_id', '=', 'product.id')
        ->whereMonth('order.created_at', '=', $val['month'])
        ->whereYear('order.created_at', '=', $val['year'])
        ->groupBy('product.code', 'product.name', 'product.price')
        ->orderBy('sumnumber', 'desc')
        ->orderBy('sumprice', 'desc')
        ->get();
        
        $filename = $report->name.'_'.$report->year.'_'.$report->month.'.pdf';
        $html = view('report.pdf_salesbyproduct', compact('orders', 'report'))->render();
        $mpdf = new mPDF('th', 'A4');
        $mpdf->WriteHTML(file_get_contents('css/pdf.css'),1);
        $mpdf->WriteHTML($html,2);
        $mpdf->SetTitle($filename);
        $mpdf->Output();
        // return view('report.pdf_salesbycategory', compact('orders', 'report'));
    }

}
