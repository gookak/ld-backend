<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
	public function __construct()
	{
		$this->middleware('auth:admin');
		$this->middleware('employee');
		//$this->middleware('employee',['except'=>'index']);
	}

	public function index(){
		return view('admin.employee');
	}
}
