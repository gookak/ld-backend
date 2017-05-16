<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductImage;
use App\Category;
use Illuminate\Http\Request;
use Response;
use DB;
//use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('updated_at','desc')->get();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product();
        $header_text = 'เพิ่มข้อมูลสินค้า';
        $mode = 'create';
        $form_action = '/product';
        $categoryList = Category::pluck('name', 'id')->toArray();
        return view('product.form', compact('product', 'header_text', 'mode', 'form_action', 'categoryList'));
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

        $p = $request->input('product');
        $pis = $request->input('product_image');

        DB::beginTransaction();
        try{
            $rsp = Product::create([
                'category_id' => $p['category_id'],
                'code' => $this->GeraHash(10),
                'name' => $p['name'],
                'price' => $p['price'],
                'balance' => $p['balance'],
                'detail' => $p['detail']
                ]);
            if(count($pis)){
                $i=1;
                foreach ($pis as $pi) {
                //$filename = $image->store('public');
                // $filename = Storage::put('public', $image);
                    $statusdefault = false;
                    if($i==1){
                        $statusdefault = true;
                    }
                    $rspi = ProductImage::create([
                        'product_id' => $rsp->id,
                        'fileupload_id' => $pi['fileupload_id'],
                        'sort' => $i,
                        'statusdefault' => $statusdefault
                        ]);
                    $i++;
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
        $data = ['status' => $status, 'msgerror' => $msgerror, 'rsp' => $rsp];
        return Response::json($data);

        // $data = $p['category_id'] ;//['status' => $p['category_id']];
        // return Response::json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        $header_text = 'แก้ไขข้อมูลสินค้า';
        $mode = 'edit';
        $form_action = '/product/'.$product->id;
        $categoryList = Category::pluck('name', 'id')->toArray();
        return view('product.form', compact('product', 'header_text', 'mode', 'form_action', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        $status = 200;
        $msgerror = "";

        $p = $request->input('product');
        $pis = $request->input('product_image');

        DB::beginTransaction();
        try{
            $rsp = $product->category_id = $p['category_id'];
            $product->name = $p['name'];
            $product->price = $p['price'];
            $product->balance = $p['balance'];
            $product->detail = $p['detail'];
            $product->save();

            $d = ProductImage::where('product_id', $product->id)->delete();
            if($pis){
                $i=1;
                foreach ($pis as $pi) {
                //$filename = $image->store('public');
                // $filename = Storage::put('public', $image);
                    $statusdefault = false;
                    if($i==1){
                        $statusdefault = true;
                    }
                    $rspi = ProductImage::create([
                        'product_id' => $product->id,
                        'fileupload_id' => $pi['fileupload_id'],
                        'sort' => $i,
                        'statusdefault' => $statusdefault
                        ]);
                    $i++;
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
        $data = ['status' => $status, 'msgerror' => $msgerror, 'd' => $d, 'pis' => $pis, 'rsp' => $rsp];
        return Response::json($data);

        // $data = $product;
        // return Response::json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        $status = 200;
        $msgerror = "";
        DB::beginTransaction();
        try{
            $rs = $product->delete();
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

    public function GeraHash($qtd){ 
    //Under the string $Caracteres you write all the characters you want to be used to randomly generate the code. 
        $Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789'; 
        $QuantidadeCaracteres = strlen($Caracteres); 
        $QuantidadeCaracteres--; 

        $Hash=NULL; 
        for($x=1;$x<=$qtd;$x++){ 
            $Posicao = rand(0,$QuantidadeCaracteres); 
            $Hash .= substr($Caracteres,$Posicao,1); 
        } 
        return $Hash; 
    } 

}
