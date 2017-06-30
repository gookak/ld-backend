<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Response;
use DB;

class CategoryController extends Controller
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
        $categorys = Category::orderBy('updated_at','desc')->get();
        return view('category.index', compact('categorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();
        $header_text = 'เพิ่มประเภทสินค้า';
        $mode = 'create';
        $form_action = '/category';
        return view('category.form', compact('category', 'header_text', 'mode', 'form_action'));
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
        DB::beginTransaction();
        try{
            $checkName = Category::where('name', $request->input('name') )->get();
            if ( count($checkName) ) {
                $status = 500;
                $msgerror = $msgerror.'<br>- ชื่อนี้มีการใช้งานอยู่แล้ว';
            }

            if($status == 200){
                $rs = Category::create([
                    'name' => $request->input('name'),
                    'detail' => $request->input('detail')
                    ]);
            }
        } catch (\Exception $ex) {
            $status = 500;
            $msgerror = $ex->getMessage();
            DB::rollback();
        }
        DB::commit();
        if ($status == 200) {
            $msgerror = 'บันทึกข้อมูลเรียบร้อย';
        }
        $data = ['status' => $status, 'msgerror' => $msgerror];
        return Response::json($data);

        // // $this->validate($request, [
        // //     'name' => 'required'
        // //     ]);

        // // dd($request->all());
        // // Category::create($request->all());

        // try{
        //     Category::create([
        //         'name' => $request->input('name'),
        //         'detail' => $request->input('detail')
        //         ]);
        // } catch (\Exception $ex) {

        // }
        
        // return redirect('/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        // dd($category);
        $header_text = 'แก้ไขประเภทสินค้า';
        $mode = 'edit';
        $form_action = '/category/'.$category->id;
        return view('category.form', compact('category', 'header_text', 'mode', 'form_action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)  //
    {
        $status = 200;
        $msgerror = "";
        DB::beginTransaction();
        try{

            $checkName = Category::where('name', $request->input('name') )->get();
            if ( count($checkName) ) {
                if($checkName[0]->name != $category->name){
                    $status = 500;
                    $msgerror = $msgerror.'<br>- ชื่อนี้มีการใช้งานอยู่แล้ว';
                }
            }

            if($status == 200){
                $rs = $category->name = $request->input('name');
                $category->detail = $request->input('detail');
                $category->save();
            }

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

        // try{
        //     $category->name = $request->input('name');
        //     $category->detail = $request->input('detail');
        //     $category->save();
        // } catch (\Exception $ex) {

        // }
        // return redirect('/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        $status = 200;
        $msgerror = "";
        DB::beginTransaction();
        try{
            $rs = $category->delete();
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
