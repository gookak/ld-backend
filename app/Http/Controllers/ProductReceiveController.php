<?php

namespace App\Http\Controllers;


use App\Product;
use App\ProductReceive;
use App\Category;
use Illuminate\Http\Request;
use Response;
use DB;
use Auth;
//use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductReceiveController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $val = $request->all();

        $status = 200;
        $msgerror = "";

        DB::beginTransaction();
        try{
            $product = Product::find($val['product_id']);
            // $sum = $product->balance + $val['number'];
            $rsp = $product->balance = $product->balance + $val['number'];
            $product->save();

            if($rsp){
                $rsprc = ProductReceive::create([
                    'product_id' => $val['product_id'],
                    'number' => $val['number'],
                    'note' => $val['note'],
                    'admins_id' => Auth::user()->id
                    ]);
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
        $data = ['status' => $status, 'msgerror' => $msgerror];
        return Response::json($data);

        return Response::json($request->all());
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
