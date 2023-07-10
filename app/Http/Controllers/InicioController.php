<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function Home(){
        session_start();
        if(isset($_SESSION['usuario'])){
            if(isset($_SESSION['usuario'])){

            }
        return view('inicio');
    }else {
        return redirect()->route('login', app()->getLocale());
    }

    }


}
