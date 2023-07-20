<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CheckBillController extends Controller
{
    public function Lista(){
        session_start();
        if(isset($_SESSION['usuario'])){
            if(isset($_SESSION['usuario'])){
                $facturas = DB::select("SELECT * FROM PRVfacturas WHERE ID_usuario = {$_SESSION['usuario']->ID}");
            }
        return view('facturas.consulta.factura-list')->with('facturas',$facturas);
        }else {
            return redirect()->route('login', app()->getLocale());
        }
    }

}
