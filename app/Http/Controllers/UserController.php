<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function UpdateUser(){
        session_start();
        if(isset($_SESSION['usuario'])){
            if(isset($_SESSION['usuario'])){

            }
        return view('inicio');
    }else {
        return redirect()->route('updateuser', app()->getLocale());
    }

    }
}
