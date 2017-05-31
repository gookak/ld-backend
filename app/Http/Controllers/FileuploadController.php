<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fileupload;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\FileUploadRequest;
use DB;
use Response;
use File;

class FileuploadController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
        // $this->middleware('admin');
	}
	
	public function index()
	{
		$fileuploads = Fileupload::orderBy('updated_at','desc')->get();
		return view('fileupload.index', compact('fileuploads'));
	}

	public function show()
	{
		// $files = Storage::files('public');
		$url = Storage::url('7fonNYTrmqToTZjB6tVXlKXZagC0vpMHwyk5uWAn.jpeg');
		$url2 = Storage::url('public/product/rpKn8rwfwrUxwfsC98GHvapUPK7gLec1BRNYm6dW.jpeg');
		$image = "<img src='".$url2."'/>";
		return $image;
	}

	public function upload(FileUploadRequest $request)
	{
		DB::beginTransaction();
		try{
			foreach ($request->images as $image) {
				//$filename = $image->store('public');
				//$filename = Storage::put('public/uploads', $image);
				$filename = $image->store('products', 'uploads');
				Fileupload::create([
					'filename' => $image->hashName()
					]);
			}
		} catch (\Exception $ex) {
			DB::rollback();
		}
		DB::commit();

		//return redirect('fileupload');
		return back();
	}

	public function destroy($id)
	{
		$status = 200;
		$msgerror = "";
		DB::beginTransaction();
		try{
			$fileupload = Fileupload::find($id);
			if($fileupload){
				// \File::delete('uploads/products/'.$fileupload->filename);
				\File::delete( substr(env('FILE_URL'), 1).$fileupload->filename );
				$rs = $fileupload->delete();
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
	}
}
