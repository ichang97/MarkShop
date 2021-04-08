<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function ShowIndex(){
        //get all product
        $products = DB::table('products')
                    ->select(
                        'products.id as product_id', 'products.product_name', 'products.price', 'products.product_type',
                        'products.product_img','product_types.id as type_id', 'product_types.type_name',
                        'products.product_code'
                    )
                    ->join('product_types', 'products.product_type', '=', 'product_types.id')
                    ->where('products.product_status', '=', 1)
                    ->get();

        return view('index', compact('products'));
    }
}
