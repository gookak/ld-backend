<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductImage;
use App\Category;
use Illuminate\Http\Request;
use Response;
use DB;
use mPDF;
use Auth;
use App\Mylibs\Mylibs;
use Carbon\Carbon;
//use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
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
        $products = Product::orderBy('updated_at','desc')->get();
        $categoryList = Category::pluck('name', 'id')->toArray();
        return view('product.index', compact('products', 'categoryList'));
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
                // 'balance' => $p['balance'],
                'balance_check' => $p['balance_check'],
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
        $header_text='ข้อมูลสินค้า';
        return view('product.show', compact('product', 'header_text'));
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
            // $product->balance = $p['balance'];
            $product->balance_check = $p['balance_check'];
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
            ProductImage::where('product_id', $product->id)->delete();
            $product->delete();
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

    public function addreceive($id)
    {
        $header_text = 'เพิ่มรายการรับสินค้า';
        $form_action = '/productreceive';

        $product = Product::find($id);
        return view('product.receiveform', compact('product', 'header_text', 'form_action'));
    }

    public function outofstock()
    {
        // $products = Product::where('balance', '<=', 'balance_check')
        // ->orderBy('balance','asc')
        // ->get();

        // $products = DB::table('product as p')
        // ->where('p.balance', '<=', 'p.balance_check')
        // ->join('category as c', 'p.category_id', '=', 'c.id')
        // ->orderBy('p.balance','asc')
        // ->get();

        $products = Product::orderBy('category_id','asc')
        ->orderBy('balance','asc')
        ->get();

        foreach ($products as $key => $product) {
            if($product->balance > $product->balance_check){
                unset($products[$key]);
            }
        }

        return view('product.outofstock', compact('products'));
    }

    public function pdf_productoutofstock()
    {
        $products = Product::orderBy('category_id','asc')
        ->orderBy('balance','asc')
        ->get();
        foreach ($products as $key => $product) {
            if($product->balance > $product->balance_check){
                unset($products[$key]);
            }
        }

        $categorys = Product::select('category.id', 'category.name', 'product.balance', 'product.balance_check')
        ->join('category', 'product.category_id', '=', 'category.id')
        ->orderBy('category.id', 'asc')
        ->distinct()
        ->get();
        foreach ($categorys as $key => $category) {
            if($category->balance > $category->balance_check){
                unset($categorys[$key]);
            }
        }

        $reportname = 'รายงานสินค้าขาดสต๊อก';
        $filename = $reportname.'.pdf';
        $html = view('product.pdf_productoutofstock', compact('products','categorys', 'reportname'))->render();
        $mpdf = new mPDF('th', 'A4-L');
        $mpdf->SetFooter($reportname
            .'|{PAGENO}/{nbpg}|'
            .' พิมพ์โดย '.Auth::user()->firstname.' '.Auth::user()->lastname
            .'<br>'
            .'วันที่พิมพ์ '.Carbon::now('asia/bangkok')->addYears(543)->format('d/m/Y H:i'));
        $mpdf->WriteHTML(file_get_contents('css/pdf.css'),1);
        $mpdf->WriteHTML($html,2);
        $mpdf->SetTitle($filename);
        $mpdf->Output();

        // return view('product.pdf_productoutofstock', compact('products'));
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
