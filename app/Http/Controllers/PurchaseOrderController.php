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
        $purchasestatusList = PurchaseStatus::pluck('detail', 'id')->toArray();
        return view('purchaseorder.index', compact('purchaseorders', 'purchasestatusList'));
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
            if(count($pods) < 1){
                $rspo = PurchaseOrder::create([
                    'admin_id' => Auth::user()->id,
                    'vendor_id' => $po['vendor_id'],
                    'purchase_status_id' => $po['purchase_status_id'],
                    'code' => Mylibs::GeraHash(10),
                    'order_at' => Mylibs::dateToDB( $po['order_at'] ),
                    'complete_at' => Mylibs::dateToDB( $po['complete_at'] ),
                    'note' => $po['note']
                    ]);

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

        $data = ['status' => $status, 'msgerror' => $msgerror ];
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
        $purchaseorder = PurchaseOrder::find($id);
        $purchasestatuss = Purchasestatus::all();
        return view('purchaseorder.show', compact('purchaseorder', 'purchasestatuss'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchaseorder = PurchaseOrder::find($id);
        $header_text = 'แก้ไขรายการสั่งของ';
        $mode = 'edit';
        $form_action = '/purchaseorder/'.$purchaseorder->id;
        $purchasestatusList = PurchaseStatus::pluck('detail', 'id')->toArray();
        $vendorList = Vendor::pluck('name', 'id')->toArray();
        return view('purchaseorder.form', compact('purchaseorder', 'header_text', 'mode', 'form_action', 'purchasestatusList', 'vendorList'));
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

        $po = $request->input('purchase_order');
        $pods = $request->input('purchase_order_detail');

        DB::beginTransaction();
        try{
            $rspo = PurchaseOrder::find($id);
            $rspo->vendor_id = $po['vendor_id'];
            $rspo->purchase_status_id = $po['purchase_status_id'];
            $rspo->order_at = Mylibs::dateToDB( $po['order_at'] );
            $rspo->complete_at = Mylibs::dateToDB( $po['complete_at'] );
            $rspo->note = $po['note'];
            $rspo->save();

            if(count($pods)){
                PurchaseOrderDetail::where('purchase_order_id', $id)->delete();
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

        $data = ['status' => $status, 'msgerror' => $msgerror, 'rspo' => $po, 'rspod' => $pods];
        return Response::json($data);

        // $val = $request->all();
        // $data = $val ;
        // return Response::json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = 200;
        $msgerror = "";
        DB::beginTransaction();
        try{
            $rspod = PurchaseOrderDetail::where('purchase_order_id', $id)->delete();
            $rspo = PurchaseOrder::find($id)->delete();
        } catch (\Exception $ex) {
            $status = 500;
            $msgerror = $ex->getMessage();
            DB::rollback();
        }
        DB::commit();
        if ($msgerror == "") {
            $msgerror = 'บันทึกข้อมูลเรียบร้อย';
        }
        $data = ['status' => $status, 'msgerror' => $msgerror];
        return Response::json($data);
    }

    public function pdf($id)
    {
        $purchaseorder = PurchaseOrder::find($id);
        $filename = 'purchase_order_'.$purchaseorder->code.'.pdf';
        $html = view('purchaseorder.pdf', compact('purchaseorder'))->render();
        $mpdf = new mPDF('th', 'A4');
        $mpdf->WriteHTML(file_get_contents('css/pdf.css'),1);
        $mpdf->WriteHTML($html,2);
        $mpdf->Output($filename, 'I');
        // return view('purchaseorder.pdf', compact('purchaseorder'));
    }
}
