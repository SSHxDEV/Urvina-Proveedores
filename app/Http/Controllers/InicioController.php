<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function Home(){
        session_start();
    //     if(isset($_SESSION['usuario'])){
    //         if(isset($_SESSION['usuario'])){
    //             $articulos = DB::select(
    //                 "EXEC spPresupuestoApp :id",
    //                 [
    //                     "id" => $_SESSION['usuario']->UsuarioCteCorp,

    //                 ]
    //             );
    //         }
    //     return view('inicio')->with('articulos',$articulos);
    // }else {
    //     return redirect()->route('login', app()->getLocale());
    // }
        return view('inicio');

    }


}
