<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorHandleController extends Controller
{
    public function ShowErrorMsg($title,$msg){
        $data = [
            'title' => $title,
            'msg' => $msg,
            'type' => 'error'
        ];

        return $data;
    }

    public function ShowSuccessMsg($title,$msg){
        $data = [
            'title' => $title,
            'msg' => $msg,
            'type' => 'success'
        ];

        return $data;
    }
}
