<?php

namespace App\Http\Controllers;

use App\PurchaseOrder;
use App\PurchaseOrderDetail;
use App\PurchaseStatus;
use App\Vendor;
use Auth;
use Illuminate\Http\Request;
use Response;
use DB;
use Carbon\Carbon;
use App\Mylibs\Mylibs;
use App;
use mPDF;

class PurchaseOrderController extends Controller
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
        $purchaseorders = PurchaseOrder::orderBy('updated_at','desc')->get();
        return view('purchaseorder.index', compact('purchaseorders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $purchaseorder = new PurchaseOrder();
        $header_text = 'เพิ่มรายการสั่งของ';
        $mode = 'create';
        $form_action = '/purchaseorder';
        $purchasestatusList = PurchaseStatus::pluck('detail', 'id')->toArray();
        $vendorList = Vendor::pluck('name', 'id')->toArray();
        return view('purchaseorder.form', compact('purchaseorder', 'header_text', 'mode', 'form_action', 'purchasestatusList', 'vendorList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = 200;
        $msgerror = "";

        $po = $request->input('purchase_order');
        $pods = $request->input('purchase_order_detail');

        DB::beginTransaction();
        try{
            $rspo = PurchaseOrder::create([
                'admin_id' => Auth::user()->id,
                'vendor_id' => $po['vendor_id'],
                'purchase_status_id' => $po['purchase_status_id'],
                'code' => Mylibs::GeraHash(10),
                'order_at' => Mylibs::dateToDB( $po['order_at'] ),
                'complete_at' => Mylibs::dateToDB( $po['complete_at'] ),
                'note' => $po['note']
                ]);
            if(count($pods)){
                foreach ($pods as $pod) {
                    $rspod = PurchaseOrderDetail::create([
                        'purchase_order_id' => $rspo->id,
                        'name' => $pod['name'],
                        'number' => $pod['number']
                        ]);
                }
            }
        } catch (\Exception $ex) {
            DB::rollback();
            $status = 500;
            $msgerror = $ex->getMessage();
        }
        DB::commit();
        if ($msgerror == "") {
            $msgerror = 'บันทึกข้อมูลเรียบร้อย';
        }

        $data = ['status' => $status, 'msgerror' => $msgerror, 'rspo' => $rspo, 'rspod' => $rspod];
        return Response::json($data);

        // $val = $request->all();
        // $data = $val ;
        // return Response::json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
