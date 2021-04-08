<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ErrorHandleController;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get product type
        $product_types = DB::table('product_types')->get();

        //get all products
        $products = DB::table('products')
                    ->select(
                        'products.id as product_id', 'products.product_name', 'products.product_code',
                        'products.product_img', 'products.created_at', 'product_types.type_name',
                        'products.product_desc','products.price', 'products.product_type'
                    )
                    ->join('product_types', 'product_types.id' ,'=', 'products.product_type')
                    ->orderBy('products.id','asc')
                    ->get();

        return view('products.index',compact('product_types', 'products'));
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
        
        $handle = new ErrorHandleController();

        if($request->txt_productcode == ""){
            $result = $handle->ShowErrorMsg("Error", "Please enter product code");
            return redirect()->route('products.index')->with('result', $result);
        }elseif($request->txt_productname == ""){
            $result = $handle->ShowErrorMsg("Error", "Please enter product name");
            return redirect()->route('products.index')->with('result', $result);
        }elseif($request->txt_productdesc == ""){
            $result = $handle->ShowErrorMsg("Error", "Please enter product description");
            return redirect()->route('products.index')->with('result', $result);
        }elseif($request->txt_price == ""){
            $result = $handle->ShowErrorMsg("Error", "Please enter price per unit");
            return redirect()->route('products.index')->with('result', $result);
        }elseif($request->txt_price < 0){
            $result = $handle->ShowErrorMsg("Error", "Please enter positive number");
            return redirect()->route('products.index')->with('result', $result);
        }elseif($request->txt_img == ""){
            $result = $handle->ShowErrorMsg("Error", "Please enter product image");
            return redirect()->route('products.index')->with('result', $result);
        }elseif($request->txt_type == ""){
            $result = $handle->ShowErrorMsg("Error", "Please enter product type");
            return redirect()->route('products.index')->with('result', $result);
        }else{
            $products = DB::table('products')->insert([
                'product_name' => $request->txt_productname,
                'product_code' => $request->txt_productcode,
                'product_desc' => $request->txt_productdesc,
                'price' => $request->txt_price,
                'product_img' => $request->txt_img,
                'product_type' => $request->txt_type,
                'product_status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
    
            if($products){
                $result = $handle->ShowSuccessMsg("Success!", "Add product completed.");
            }else{
                $result = $handle->ShowErrorMsg("Error!", "Add product error, Please try again.");
            }
    
            return redirect()->route('products.index')->with('result', $result);
        }
        
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
        $handle = new ErrorHandleController();

        $products = DB::table('products')->where('id', '=', $id)
                    ->update([
                        'product_name' => $request->input('txt_productname'.$id),
                        'product_code' => $request->input('txt_productcode'.$id),
                        'product_desc' => $request->input('txt_productdesc'.$id),
                        'price' => $request->input('txt_price'.$id),
                        'product_img' => $request->input('txt_img'.$id),
                        'product_type' => $request->input('txt_type'.$id),
                        'updated_at' => now()
                    ]);
        
        if($products){
            $result = $handle->ShowSuccessMsg("Success!", "Update product completed.");
        }else{
            $result = $handle->ShowErrorMsg("Error!", "Update product error, Please try again.");
        }

        return redirect()->route('products.index')->with('result', $result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $handle = new ErrorHandleController();
        $product = DB::table('products')->where('id', '=', $id)->delete();

        if($product){
            $result = $handle->ShowSuccessMsg("Success!", "Delete product completed.");
        }else{
            $result = $handle->ShowErrorMsg("Error!", "Delete product error, Please try again.");
        }

        return redirect()->route('products.index')->with('result', $result);
    }
}
