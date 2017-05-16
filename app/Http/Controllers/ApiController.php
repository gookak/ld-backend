<?php

namespace App\Http\Controllers;

use App\Fileupload;
use Illuminate\Http\Request;
use Response;
use DB;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
    public function apigetfileupload()
    {
        $status = 200;
        $rs = Fileupload::orderBy('updated_at','desc')->get();
        foreach ($rs as $row) {
            // $row->setAttribute('url', '/uploads/products/'.$row->filename);
            $row->setAttribute('url', env('FILE_URL').$row->filename);
        }
        //echo $rs;
        $data = ['status' => $status, 'rs' => $rs];
        return Response::json($data);
    }

}
