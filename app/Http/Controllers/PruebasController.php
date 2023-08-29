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

class PruebasController extends Controller
{
    public function ArrayComparer($language, $orden){
        $costos = DB::select("SELECT costo from compratcalc where mov='Entrada Compra' and movid= '$orden'");
        $importes = DB::select("SELECT importe from compratcalc where mov='Entrada Compra' and movid= '$orden'");
        $cantidades = DB::select("SELECT cantidad from compratcalc where mov='Entrada Compra' and movid= '$orden'");
        return view('test.arrayComparer')->with('costos',$costos)->with('importes',$importes)->with('cantidades',$cantidades);
    }
}
