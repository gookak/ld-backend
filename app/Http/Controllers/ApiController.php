<?php

namespace App\Http\Controllers;

use App\Fileupload;
use Illuminate\Http\Request;
use Response;
use DB;
use Illuminate\Support\Facades\Storage;
use App\Order;
use App\User;
use App\Product;
use Carbon\Carbon;
use App\Mylibs\Mylibs;

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

    public function apigetpercentpricebycategorys()
    {
        $status = 200;
        $sumPriceByCategorys= Order::select('category.name', DB::raw('sum(order_detail.number * order_detail.price) as sale'))     //, DB::raw('sum(order_detail.number) AS number')
        ->join('order_detail', 'order.id', '=', 'order_detail.order_id')
        ->join('product', 'order_detail.product_id', '=', 'product.id')
        ->join('category', 'product.category_id', '=', 'category.id')
        ->whereDate('order.created_at', '=', date('Y-m-d'))
        ->groupBy('category.name')
        //->orderBy('number', 'desc')->limit(5)
        ->get();
        $totalSale = 0;
        foreach ($sumPriceByCategorys  as $key => $sumPriceByCategory) {
            $totalSale += $sumPriceByCategory->sale;
        }
        foreach ($sumPriceByCategorys  as $key => $sumPriceByCategory) {
            $sumPriceByCategory['percent'] = number_format(($sumPriceByCategory->sale * 100) / $totalSale);
            unset($sumPriceByCategory['sale']);
        }
        

        $data = ['status' => $status, 'rs' => $sumPriceByCategorys];
        return Response::json($data);
    }

    public function apigetproductname($name)
    {
        $status = 200;
        $rs = Product::where('name', 'like', '%'.$name.'%')->get();
        $data = ['status' => $status, 'rs' => $rs];
        return Response::json($data);
    }

}
