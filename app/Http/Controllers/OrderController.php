<?php

namespace App\Http\Controllers;

use App\Order;
use App\TransportStatus;
use Illuminate\Http\Request;
use Response;
use DB;
use Carbon\Carbon;
use App\Mylibs\Mylibs;
use PDF;
use App;
use mPDF;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('updated_at','desc')->get();
        // foreach ($orders  as $key => $order) {
        //     $order->created_at = Mylibs::dateToView($order->created_at);
        // }
        return view('order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        $transportstatus=TransportStatus::all();
        $order=Order::find($id);
        // $order->created_at = Mylibs::dateToView($order->created_at);
        return view('order.show', compact('order', 'transportstatus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order=Order::find($id);
        // $order->send_at = Mylibs::datetimeToView($order->send_at);
        // $order->complete_at = Mylibs::datetimeToView($order->complete_at);
        $header_text = 'แก้ไขรายการสั่งซื้อ';
        $mode = 'edit';
        $form_action = '/order/'.$order->id;
        $transportstatusList = TransportStatus::pluck('detail', 'id')->toArray();
        return view('order.form', compact('order', 'header_text', 'mode', 'form_action', 'transportstatusList'));
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
        $status = 200;
        $msgerror = "";
        DB::beginTransaction();
        try{
            // $a = Mylibs::dateToDB( $request->input('send_at') );
            $data = $request->all();
            $order = Order::find($id);
            $order->transportstatus_id = $request->input('transportstatus_id');
            $order->emscode = $request->input('emscode');
            $order->send_at = Mylibs::dateToDB( $request->input('send_at') );
            $order->complete_at = Mylibs::dateToDB( $request->input('complete_at') );
            $rs = $order->save();
        } catch (\Exception $ex) {
            $status = 500;
            $msgerror = $ex->getMessage();
            DB::rollback();
        }
        DB::commit();
        if ($msgerror == "") {
            $msgerror = 'บันทึกข้อมูลเรียบร้อย';
        }
        $data = ['status' => $status, 'msgerror' => $msgerror, 'rs' => $rs];
        return Response::json($data);
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

    public function pdf($id)
    {
        $order = Order::find($id);
        $filename = 'order_'.$order->code.'.pdf';
        $html = view('order.pdf', compact('order'))->render();
        $mpdf = new mPDF('th', 'A4');
        $mpdf->WriteHTML(file_get_contents('css/pdf.css'),1);
        $mpdf->WriteHTML($html,2);
        $mpdf->Output($filename, 'I');
        // return view('order.pdf', compact('order'));
    }
}
