<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Seller;
use Response;
use DB;
use App\Mylibs\Mylibs;

class SellerController extends Controller
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
        $sellers = Seller::orderBy('updated_at','desc')->get();
        return view('seller.index', compact('sellers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $seller = new Seller();
        $header_text = 'เพิ่มข้อมูลคู่ค้า';
        $mode = 'create';
        $form_action = '/seller';
        return view('seller.form', compact('seller', 'header_text', 'mode', 'form_action'));
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
            $rs = Seller::create([
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
        $data = ['status' => $status, 'msgerror' => $msgerror, 'rs' => $val];
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
        $seller = Seller::find($id);
        $header_text = 'แก้ไขข้อมูลคู่ค้า';
        $mode = 'edit';
        $form_action = '/seller/'.$seller->id;
        return view('seller.form', compact('seller', 'header_text', 'mode', 'form_action'));
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
            $seller = Seller::find($id);
            $rs = $seller->name = $val['name'];
            $seller->address = $val['address'];
            $seller->tel = $val['tel'];
            $seller->fax = $val['fax'];
            $seller->save();
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
            $seller = Seller::find($id);
            $rs = $seller->delete();
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
