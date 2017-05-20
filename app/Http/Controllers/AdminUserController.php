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
        $val = $request->all();
        $status = 200;
        $msgerror = "";
        DB::beginTransaction();
        try{
            $checkEmail = Admin::where('email', $val['email'])->get();
            if (!count($checkEmail)) {
                $rs = Admin::create([
                    'role_id' => $val['role_id'],
                    'name' => $val['name'],
                    'email' => $val['email'],
                    'password' => bcrypt($val['password'])
                    ]);
            }else{
                $status = 500;
                $msgerror = 'อีเมล์นี้มีการใช้งานอยู่แล้ว';
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
        // $data = ['status' => $input ];
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
        $adminuser = Admin::find($id);
        $header_text = 'แก้ไขประเภทสินค้า';
        $mode = 'edit';
        $form_action = '/adminuser/'.$adminuser->id;
        $roleList = Role::pluck('name', 'id')->toArray();
        return view('adminuser.form', compact('adminuser', 'header_text', 'mode', 'form_action', 'roleList'));
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
            $adminuser = Admin::find($id);
            $checkEmail = Admin::where('email', $val['email'])->get();
            if (count($checkEmail)) {
                if($checkEmail[0]->email == $adminuser->email){
                    $rs = $adminuser->role_id = $val['role_id'];
                    $adminuser->name = $val['name'];
                    $adminuser->email = $val['email'];
                    $adminuser->password = bcrypt($val['password']);
                    $adminuser->save();
                }else{
                    $status = 500;
                    $msgerror = 'อีเมล์นี้มีการใช้งานอยู่แล้ว';
                }
            }else{
                $rs = $adminuser->role_id = $val['role_id'];
                $adminuser->name = $val['name'];
                $adminuser->email = $val['email'];
                $adminuser->password = bcrypt($val['password']);
                $adminuser->save();
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
        // $data = ['status' => $input ];
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
            $adminuser = Admin::find($id);
            $rs = $adminuser->delete();
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
