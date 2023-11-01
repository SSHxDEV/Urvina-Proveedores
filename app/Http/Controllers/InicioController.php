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

                if($_SESSION['usuario']->rol == "finanzas" ||$_SESSION ['usuario']->rol == "administrador"){
                    $Totalp = DB::select("SELECT COUNT(*) AS total FROM PRVusuarios WHERE rol = 'proveedor'");
                    $Totalfr = DB::select("SELECT COUNT(*) AS total FROM PRVfacturas WHERE estatus = 'Revision'");
                    $Totalfa = DB::select("SELECT COUNT(*) AS total FROM PRVfacturas WHERE estatus = 'Aceptado'");
                    $Totalfc = DB::select("SELECT COUNT(*) AS total FROM PRVfacturas WHERE estatus = 'Rechazado'");

                    return view('inicio')->with('Totalp', $Totalp)->with('Totalfr', $Totalfr)->with('Totalfc', $Totalfc)->with('Totalfa', $Totalfa);
                }
                if($_SESSION['usuario']->rol == "colaborador"){
                    $ID = $_SESSION ['usuario']->ID;
                    $Totalp = DB::select("SELECT COUNT(*) AS total FROM PRVfacturas WHERE ID_usuario = $ID");
                    $Totalfr = DB::select("SELECT COUNT(*) AS total FROM PRVfacturas WHERE estatus = 'Revision' AND ID_usuario = $ID");
                    $Totalfa = DB::select("SELECT COUNT(*) AS total FROM PRVfacturas WHERE estatus = 'Aceptado' AND ID_usuario = $ID");
                    $Totalfc = DB::select("SELECT COUNT(*) AS total FROM PRVfacturas WHERE estatus = 'Rechazado' AND ID_usuario = $ID");

                    return view('inicio')->with('Totalp', $Totalp)->with('Totalfr', $Totalfr)->with('Totalfc', $Totalfc)->with('Totalfa', $Totalfa);
                }
            }
        return view('inicio');
    }else {
        return redirect()->route('login', app()->getLocale());
    }

    }


}
