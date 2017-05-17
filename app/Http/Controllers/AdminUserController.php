<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Role;
use Response;
use DB;

class AdminUserController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminusers = Admin::orderBy('updated_at','desc')->get();
        return view('adminuser.index', compact('adminusers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $adminuser = new Admin();
        $header_text = 'เพิ่มข้อมูลผู้ใช้งาน';
        $mode = 'create';
        $form_action = '/adminuser';
        $roleList = Role::pluck('name', 'id')->toArray();
        return view('adminuser.form', compact('adminuser', 'header_text', 'mode', 'form_action', 'roleList'));
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
        // $status = 200;
        // $msgerror = "";
        // DB::beginTransaction();
        // try{
        //     // $rs = Category::create([
        //     //     'name' => $request->input('name'),
        //     //     'detail' => $request->input('detail')
        //     //     ]);
        // } catch (\Exception $ex) {
        //     $status = 500;
        //     $msgerror = $ex->getMessage();
        //     DB::rollback();
        // }
        // DB::commit();
        // if ($msgerror == "") {
        //     $msgerror = 'บันทึกข้อมูลเรียบร้อย';
        // }
        // $data = ['status' => $status, 'msgerror' => $msgerror, 'rs' => $rs];
        $data = ['status' => '555'];
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
