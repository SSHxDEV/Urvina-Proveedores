<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use PhpCfdi\SatEstadoCfdi\Soap\SoapConsumerClient;
use PhpCfdi\SatEstadoCfdi\Soap\SoapClientFactory;
use PhpCfdi\SatEstadoCfdi\Consumer;
use ZipArchive;
use Jenssegers\Date\Date;
use Carbon\Carbon;
use DateTime;

class SupervisionController extends Controller
{
    public function Lista($language, $receptor){
        session_start();
        if($receptor == "USI"){
            Date::setLocale('es');
            $data=array();
                $facturas = DB::select("SELECT * from PRVfacturas where receptor='USI970814616'");
                foreach ($facturas as $factura) {
                    $ModFecha = Date::parse($factura->fecha_modificacion);
                    $IngFecha = Date::parse($factura->fecha_ingreso);
                    $IFecha = $IngFecha->format('l, j F Y H:i:s');
                    $MFecha = $ModFecha->format('l, j F Y H:i:s');
                    $factura->IFecha = $IFecha;
                    $factura->MFecha = $MFecha;
                    array_push($data, $factura);
                }
            return view('supervision.consulta')->with('data', $data);
        }
        if($receptor == "COELI"){
            $data=array();
                $facturas = DB::select("SELECT * from PRVfacturas where receptor='CME980528JB6'");
                foreach ($facturas as $factura) {
                    $ModFecha = Date::parse($factura->fecha_modificacion);
                    $IngFecha = Date::parse($factura->fecha_ingreso);
                    $IFecha = $IngFecha->format('l, j F Y H:i:s');
                    $MFecha = $ModFecha->format('l, j F Y H:i:s');
                    $factura->IFecha = $IFecha;
                    $factura->MFecha = $MFecha;
                    array_push($data, $factura);
                }
            return view('supervision.consulta')->with('data', $data);
        }
        return redirect()->route('home', app()->getLocale());
    }
}
