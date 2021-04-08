<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
use App\Http\Controllers\ErrorHandleController;

class CartController extends Controller
{
    public function add_to_cart($id){
        $products = products::find($id);

        if(!$products){
            abort(404);
        }

        $cart = session()->get('cart');

        //ถ้าตะกร้าว่าง ให้ใส่สินค้าอันแรกเข้าไปเลย
        if(!$cart){
            $cart = [
                $id => [
                    "product_code" => $products->product_code,
                    "product_name" => $products->product_name,
                    "quantity" => 1,
                    "price" => $products->price,
                    "img" => $products->product_img
                ]
            ];

            session()->put('cart', $cart);

            $handle = new ErrorHandleController();
            
            $result = $handle->ShowSuccessMsg("Success", "Add to cart completed.");

            return redirect()->route('index')->with('result', $result);
        }

        //ถ้าสินค้าเคยเพิ่มในตะกร้าแล้ว ให้เพิ่มจำนวนชิ้น
        if(isset($cart[$id])){
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);

            $handle = new ErrorHandleController();
            
            $result = $handle->ShowSuccessMsg("Success", "Add to cart completed.");

            return redirect()->route('index')->with('result', $result);
        }

        //ถ้าสินค้ายังไม่เคยเพิ่มในตะกร้าและไม่ใช่สินค้าชิ้นเดิม ให้เพิ่มลงในตะกร้า
        $cart[$id] = [
            "product_code" => $products->product_code,
            "product_name" => $products->product_name,
            "quantity" => 1,
            "price" => $products->price,
            "img" => $products->product_img
        ];


        session()->put('cart', $cart);

        $handle = new ErrorHandleController();
            
        $result = $handle->ShowSuccessMsg("Success", "Add to cart completed.");

        return redirect()->route('index')->with('result', $result);
    }

    public function ShowCart(){
        return view('carts');
    }

    public function UpdateCart(Request $request,$id){
        $handle = new ErrorHandleController();

        if($request->input('txt_qty'.$id) < 0){
            $result = $handle->ShowErrorMsg("Error!", "Please enter positive number.");

            return redirect()->route('show_cart')->with('result', $result);
        }elseif($request->input('txt_qty'.$id) == ''){
            $result = $handle->ShowErrorMsg("Error!", "Please enter quantity.");

            return redirect()->route('show_cart')->with('result', $result);
        }elseif($request->input('txt_qty'.$id) == 0){
            if($id != ''){
                $cart = session()->get('cart');
    
                if(isset($cart[$id])){
                    unset($cart[$id]);
                    session()->put('cart', $cart);
                }
            
                $result = $handle->ShowSuccessmsg("Success!", "Product removed completed.");

                return redirect()->route('show_cart')->with('result', $result);
            }
            
        }elseif($id != ''){
            $cart = session()->get('cart');

            $cart[$id]['quantity'] = $request->input('txt_qty'.$id);
            session()->put('cart', $cart);
            
            $result = $handle->ShowSuccessMsg("Success!", "Product quantity update completed.");

            return redirect()->route('show_cart')->with('result', $result);
        }else{
            abort(404);
        }

    }

    public function DeleteCart($id){

        $handle = new ErrorHandleController();

        if($id != ''){
            $cart = session()->get('cart');

            if(isset($cart[$id])){
                unset($cart[$id]);
                session()->put('cart', $cart);
            }

            $result = $handle->ShowSuccessmsg("Success!", "Product removed completed.");

            return redirect()->route('show_cart')->with('result', $result);
        }else{
            abort(404);
        }
    }
}