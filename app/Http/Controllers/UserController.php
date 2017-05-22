<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Response;
use DB;
use Carbon\Carbon;
use App\Mylibs\Mylibs;

class UserController extends Controller
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
        $users = User::where('use', true)->orderBy('updated_at','desc')->get();
        // $t = Mylibs::getNumDay($users[0]->login_at->format('Y-m-d'), date('Y-m-d'));

        foreach ($users  as $key => $user) {
            $user['numdate'] = Mylibs::getNumDay($user->login_at->format('Y-m-d'), date("Y-m-d"));
        }
        return view('user.index', compact('users', 't'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $header_text='ข้อมูลลูกค้า';
        $user=User::find($id);
        return view('user.show', compact('user', 'header_text'));
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
        $status = 200;
        $msgerror = "";
        DB::beginTransaction();
        try{
            $user = User::find($id);
            $rs = $user->delete();
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
