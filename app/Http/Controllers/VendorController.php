<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;
use Response;
use DB;
use App\Mylibs\Mylibs;

class VendorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::orderBy('updated_at','desc')->get();
        return view('vendor.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendor = new Vendor();
        $header_text = 'เพิ่มข้อมูลผู้ขาย';
        $mode = 'create';
        $form_action = '/vendor';
        return view('vendor.form', compact('vendor', 'header_text', 'mode', 'form_action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $val = $request->all();
        $status = 200;
        $msgerror = "";
        DB::beginTransaction();
        try{
            $rs = Vendor::create([
                'name' => $val['name'],
                'address' => $val['address'],
                'tel' => $val['tel'],
                'fax' => $val['fax']
                ]);
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
        $vendor = Vendor::find($id);
        $header_text = 'แก้ไขข้อมูลผู้ขาย';
        $mode = 'edit';
        $form_action = '/vendor/'.$vendor->id;
        return view('vendor.form', compact('vendor', 'header_text', 'mode', 'form_action'));
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
        $val = $request->all();
        $status = 200;
        $msgerror = "";
        DB::beginTransaction();
        try{
            $vendor = Vendor::find($id);
            $rs = $vendor->name = $val['name'];
            $vendor->address = $val['address'];
            $vendor->tel = $val['tel'];
            $vendor->fax = $val['fax'];
            $vendor->save();
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
        $status = 200;
        $msgerror = "";
        DB::beginTransaction();
        try{
            $vendor = Vendor::find($id);
            $rs = $vendor->delete();
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
}
