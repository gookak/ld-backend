<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Role;
use Response;
use DB;
use App\Mylibs\Mylibs;
use mPDF;

class AdminUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminusers = Admin::orderBy('updated_at','desc')->get();
        $roleList = Role::pluck('detail', 'id')->toArray();
        return view('adminuser.index', compact('adminusers', 'roleList'));
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
        $roleList = Role::pluck('detail', 'id')->toArray();
        $genderList = Mylibs::getGender();
        $titleList = Mylibs::getTitleName();
        return view('adminuser.form', compact('adminuser', 'header_text', 'mode', 'form_action', 'roleList', 'genderList', 'titleList'));
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
            if (count($checkEmail)) {
                $status = 500;
                $msgerror = $msgerror.'<br>- อีเมล์นี้มีการใช้งานอยู่แล้ว';
            }

            $checkIdCard = Admin::where('card_id', $val['card_id'])->get();
            if (count($checkIdCard)) {
                $status = 500;
                $msgerror = $msgerror.'<br>- เลขบัตรประชาชนนี้มีการใช้งานอยู่แล้ว';
            }

            if($status == 200){
                $rs = Admin::create([
                    'role_id' => $val['role_id'],
                    'email' => $val['email'],
                    'password' => bcrypt($val['password']),
                    'title' => $val['title'],
                    'firstname' => $val['firstname'],
                    'lastname' => $val['lastname'],
                    'card_id' => $val['card_id'],
                    'card_build_at' => Mylibs::dateToDB( $val['card_build_at'] ),
                    'card_expire_at' => Mylibs::dateToDB( $val['card_expire_at'] ),
                    'birthday' => Mylibs::dateToDB( $val['birthday'] ),
                    'gender' => $val['gender'],
                    'tel' => $val['tel'],
                    'address' => $val['address']
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
        $adminuser = Admin::find($id);
        return view('adminuser.show', compact('adminuser'));
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
        $header_text = 'แก้ไขข้อมูลผู้ใช้งาน';
        $mode = 'edit';
        $form_action = '/adminuser/'.$adminuser->id;
        $roleList = Role::pluck('detail', 'id')->toArray();
        $genderList = Mylibs::getGender();
        $titleList = Mylibs::getTitleName();
        return view('adminuser.form', compact('adminuser', 'header_text', 'mode', 'form_action', 'roleList', 'genderList', 'titleList'));
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
                if($checkEmail[0]->email != $adminuser->email){
                    $status = 500;
                    $msgerror = $msgerror.'<br>- อีเมล์นี้มีการใช้งานอยู่แล้ว';
                }
            }

            $checkIdCard = Admin::where('card_id', $val['card_id'])->get();
            if (count($checkIdCard)) {
                if($checkIdCard[0]->card_id != $adminuser->card_id){
                    $status = 500;
                    $msgerror = $msgerror.'<br>- เลขบัตรประชาชนนี้มีการใช้งานอยู่แล้ว';
                }
            }

            if($status == 200){
                $rs = $adminuser->role_id = $val['role_id'];
                $adminuser->email = $val['email'];
                // $adminuser->password = bcrypt($val['password']);
                $adminuser->title = $val['title'];
                $adminuser->firstname = $val['firstname'];
                $adminuser->lastname = $val['lastname'];
                $adminuser->card_id = $val['card_id'];
                $adminuser->card_build_at = Mylibs::dateToDB( $val['card_build_at'] );
                $adminuser->card_expire_at = Mylibs::dateToDB( $val['card_expire_at'] );
                $adminuser->birthday = Mylibs::dateToDB( $val['birthday'] );
                $adminuser->gender = $val['gender'];
                $adminuser->tel = $val['tel'];
                $adminuser->address = $val['address'];
                $adminuser->save();
            }
            // else{
            //     $rs = $adminuser->role_id = $val['role_id'];
            //     $adminuser->card_id = $val['card_id'];
            //     $adminuser->firstname = $val['firstname'];
            //     $adminuser->lastname = $val['lastname'];
            //     $adminuser->tel = $val['tel'];
            //     $adminuser->gender = $val['gender'];
            //     $adminuser->address = $val['address'];
            //     $adminuser->birthday = Mylibs::dateToDB( $val['birthday'] );
            //     $adminuser->email = $val['email'];
            //     // $adminuser->password = bcrypt($val['password']);
            //     $adminuser->save();
            // }


            // $adminuser = Admin::find($id);
            // $checkEmail = Admin::where('email', $val['email'])->get();
            // if (count($checkEmail)) {
            //     if($checkEmail[0]->email == $adminuser->email){
            //         $rs = $adminuser->role_id = $val['role_id'];
            //         $adminuser->card_id = $val['card_id'];
            //         $adminuser->firstname = $val['firstname'];
            //         $adminuser->lastname = $val['lastname'];
            //         $adminuser->tel = $val['tel'];
            //         $adminuser->gender = $val['gender'];
            //         $adminuser->address = $val['address'];
            //         $adminuser->birthday = Mylibs::dateToDB( $val['birthday'] );
            //         $adminuser->email = $val['email'];
            //         // $adminuser->password = bcrypt($val['password']);
            //         $adminuser->save();
            //     }else{
            //         $status = 500;
            //         $msgerror = 'อีเมล์นี้มีการใช้งานอยู่แล้ว';
            //     }
            // }else{
            //     $rs = $adminuser->role_id = $val['role_id'];
            //     $adminuser->card_id = $val['card_id'];
            //     $adminuser->firstname = $val['firstname'];
            //     $adminuser->lastname = $val['lastname'];
            //     $adminuser->tel = $val['tel'];
            //     $adminuser->gender = $val['gender'];
            //     $adminuser->address = $val['address'];
            //     $adminuser->birthday = Mylibs::dateToDB( $val['birthday'] );
            //     $adminuser->email = $val['email'];
            //     // $adminuser->password = bcrypt($val['password']);
            //     $adminuser->save();
            // }
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

    public function pdf($id)
    {
        $adminuser = Admin::find($id);
        $filename = $adminuser->name.'.pdf';
        $html = view('adminuser.pdf', compact('adminuser'))->render();
        $mpdf = new mPDF('th', 'A4');
        $mpdf->WriteHTML(file_get_contents('css/pdf.css'),1);
        $mpdf->WriteHTML($html,2);
        $mpdf->Output($filename, 'I');
        // return view('adminuser.pdf', compact('adminuser'));
    }
}
