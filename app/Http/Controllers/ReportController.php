<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Mylibs\Mylibs;
use App\Order;
use App\User;
use App\Category;
use App\Product;
use App\Admin;
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
        // $monthList = Mylibs::getMonthList();
        // $yearList = Mylibs::getYearList();
        return view('report.index', compact('reportList'));


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
        $report['start_date'] = $val['start_date'];
        $report['end_date'] = $val['end_date'];
        // $report['year'] = $val['year'] + 543;
        // $report['month'] = Mylibs::getMonthName($val['month']);

        $orders = Order::select('category.name', DB::raw('sum(order_detail.number) AS sumnumber'), DB::raw('sum(order_detail.number * order_detail.price) AS sumprice') )
        ->join('order_detail', 'order.id', '=', 'order_detail.order_id')
        ->join('product', 'order_detail.product_id', '=', 'product.id')
        ->join('category', 'product.category_id', '=', 'category.id')
        // ->whereMonth('order.created_at', '=', $val['month'])
        // ->whereYear('order.created_at', '=', $val['year'])
        ->whereBetween( 'order.created_at', [ Mylibs::dateToDB( $val['start_date'] ) , Mylibs::dateToDB( $val['end_date'] ) ] )
        ->where('transportstatus_id', 3)
        ->groupBy('category.name')
        ->orderBy('sumnumber', 'desc')
        ->orderBy('sumprice', 'desc')
        ->get();

        $totalprice = 0;
        foreach ($orders as $key => $order) {
            $totalprice += $order->sumprice;
        }
        // dd($this->getConvertNumberString($totalprice));

        $report['totalpricestring'] = $this->getConvertNumberString($totalprice);

        // $filename = $report->name.'_'.$report->year.'_'.$report->month.'.pdf';
        $filename = $report->name.'.pdf';
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
        $report['start_date'] = $val['start_date'];
        $report['end_date'] = $val['end_date'];
        // $report['year'] = $val['year'] + 543;
        // $report['month'] = Mylibs::getMonthName($val['month']);

        $orders = Order::select('product.code', 'product.name', 'product.price', DB::raw('sum(order_detail.number) AS sumnumber'), DB::raw('sum(order_detail.number * order_detail.price) AS sumprice') )
        ->join('order_detail', 'order.id', '=', 'order_detail.order_id')
        ->join('product', 'order_detail.product_id', '=', 'product.id')
        // ->whereMonth('order.created_at', '=', $val['month'])
        // ->whereYear('order.created_at', '=', $val['year'])
        ->whereBetween( 'order.created_at', [ Mylibs::dateToDB( $val['start_date'] ) , Mylibs::dateToDB( $val['end_date'] ) ] )
        ->where('transportstatus_id', 3)
        ->groupBy('product.code', 'product.name', 'product.price')
        ->orderBy('sumnumber', 'desc')
        ->orderBy('sumprice', 'desc')
        ->get();

        $totalprice = 0;
        foreach ($orders as $key => $order) {
            $totalprice += $order->sumprice;
        }
        // dd($this->getConvertNumberString($totalprice));

        $report['totalpricestring'] = $this->getConvertNumberString($totalprice);
        
        // $filename = $report->name.'_'.$report->year.'_'.$report->month.'.pdf';
        $filename = $report->name.'.pdf';
        $html = view('report.pdf_salesbyproduct', compact('orders', 'report'))->render();
        $mpdf = new mPDF('th', 'A4-L');
        $mpdf->WriteHTML(file_get_contents('css/pdf.css'),1);
        $mpdf->WriteHTML($html,2);
        $mpdf->SetTitle($filename);
        $mpdf->Output();
        // return view('report.pdf_salesbycategory', compact('orders', 'report'));
    }

    public function balancebyproduct(Request $request)
    {
        // dd($request->all());
        $val = $request->all();

        $report = Report::where('url', $val['report_url'])->first();
        $report['create_date'] = Carbon::now()->addYears(543)->format('d/m/Y');

        $products = Product::orderBy('balance', 'asc')
        // ->orderBy('category_id', 'asc')
        ->get();

        $filename = $report->name.'.pdf';
        $html = view('report.pdf_balancebyproduct', compact('products', 'report'))->render();
        $mpdf = new mPDF('th', 'A4-L');
        $mpdf->WriteHTML(file_get_contents('css/pdf.css'),1);
        $mpdf->WriteHTML($html,2);
        $mpdf->SetTitle($filename);
        $mpdf->Output();
        // return view('report.pdf_balancebyproduct', compact('products', 'report'));
    }

    public function employee(Request $request)
    {
        // dd($request->all());
        $val = $request->all();

        $report = Report::where('url', $val['report_url'])->first();
        $report['create_date'] = Carbon::now()->addYears(543)->format('d/m/Y');

        $employees = Admin::orderBy('role_id', 'asc')
        ->orderBy('id', 'asc')
        ->get();

        $filename = $report->name.'.pdf';
        $html = view('report.pdf_employee', compact('employees', 'report'))->render();
        $mpdf = new mPDF('th', 'A4');
        // $mpdf->SetHTMLHeader('<h1>TEST</h1>');
        $mpdf->setDisplayMode('fullpage');
        $mpdf->WriteHTML(file_get_contents('css/pdf.css'),1);
        $mpdf->WriteHTML($html,2);
        $mpdf->SetTitle($filename);
        $mpdf->Output();
        return view('report.pdf_employee', compact('employees', 'report'));
    }

    public function getConvertNumberString($amount_number)
    {
        $amount_number = number_format($amount_number, 2, ".","");
        $pt = strpos($amount_number , ".");
        $number = $fraction = "";
        if ($pt === false) 
            $number = $amount_number;
        else
        {
            $number = substr($amount_number, 0, $pt);
            $fraction = substr($amount_number, $pt + 1);
        }

        $ret = "";
        $baht = $this->ReadNumber ($number);
        if ($baht != "")
            $ret .= $baht . "บาท";

        $satang = $this->ReadNumber($fraction);
        if ($satang != "")
            $ret .=  $satang . "สตางค์";
        else 
            $ret .= "ถ้วน";
        return $ret;
    }

    private function ReadNumber($number)
    {
        $position_call = array("แสน", "หมื่น", "พัน", "ร้อย", "สิบ", "");
        $number_call = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
        $number = $number + 0;
        $ret = "";
        if ($number == 0) return $ret;
        if ($number > 1000000)
        {
            $ret .= $this->ReadNumber(intval($number / 1000000)) . "ล้าน";
            $number = intval(fmod($number, 1000000));
        }

        $divider = 100000;
        $pos = 0;
        while($number > 0)
        {
            $d = intval($number / $divider);
            $ret .= (($divider == 10) && ($d == 2)) ? "ยี่" : 
            ((($divider == 10) && ($d == 1)) ? "" :
                ((($divider == 1) && ($d == 1) && ($ret != "")) ? "เอ็ด" : $number_call[$d]));
            $ret .= ($d ? $position_call[$pos] : "");
            $number = $number % $divider;
            $divider = $divider / 10;
            $pos++;
        }
        return $ret;
    }








}
