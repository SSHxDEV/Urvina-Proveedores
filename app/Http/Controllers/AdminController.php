<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use PhpCfdi\SatEstadoCfdi\Soap\SoapConsumerClient;
use PhpCfdi\SatEstadoCfdi\Soap\SoapClientFactory;
use PhpCfdi\SatEstadoCfdi\Consumer;
use ZipArchive;
use Jenssegers\Date\Date;
use Carbon\Carbon;
use DateTime;


class AdminController extends Controller
{
    public function ControlUsuario($language){
        session_start();
        $rol = $_SESSION['usuario']->rol;
        if($rol == "administrador"){
            Date::setLocale('es');
            $data=array();
                $usuarios = DB::select("SELECT * from PRVusuarios where rol='finanzas' OR rol='administrador'");

                foreach ($usuarios as $usuario) {
                    $ModFecha = Date::parse($usuario->fecha_modificacion);
                    $IngFecha = Date::parse($usuario->fecha_ingreso);
                    $IFecha = $IngFecha->format('l, j F Y H:i:s');
                    $MFecha = $ModFecha->format('l, j F Y H:i:s');
                    $usuario->IFecha = $IFecha;
                    $usuario->MFecha = $MFecha;
                    array_push($data, $usuario);
                }
            return view('administracion.control-usuario')->with('data', $data);
        }
        return redirect()->route('home', app()->getLocale());
    }

    public function AddUser($language,Request $request){
        session_start();
        $rol = $_SESSION['usuario']->rol;
        if($rol == "administrador"){

        return view('administracion.add-usuario');
        }

        return redirect()->route('home', app()->getLocale());

    }

    public function AddUsuario($language,Request $request){
        session_start();
        $rol = $_SESSION['usuario']->rol;
        if($rol == "administrador"){
            $date = Carbon::now();
            DB::table('PRVusuarios')->insert([
                'usuario' => $request->usuario,
                'RFC' => $request->rfc,
                'clave' => $request->clave,
                'rol' => $request->rol,
                'imagen'=>'/img/user.png',
                'fecha_ingreso' => $date,
                'fecha_modificacion' => $date,
            ]);
            Alert::success(__('Registrado correctamente.'), __('Se ha registrado un nuevo Usuario.'));
        return redirect()->route('home', app()->getLocale());
        }

        return redirect()->route('home', app()->getLocale());

    }

    public function EditUser($language, $IdUser){
        session_start();
        $rol = $_SESSION['usuario']->rol;
        if($rol == "administrador"){
        $usuario = DB::select("SELECT TOP 1 * from PRVusuarios where ID=$IdUser");
        $ModFecha = Date::parse($usuario[0]->fecha_modificacion);
        $IngFecha = Date::parse($usuario[0]->fecha_ingreso);
        $IFecha = $IngFecha->format('l, j F Y H:i:s');
        $MFecha = $ModFecha->format('l, j F Y H:i:s');
        return view('administracion.edit-usuario')->with('usuario',$usuario)->with('IFecha ',$IFecha)->with('MFecha ',$MFecha);
        }

        return redirect()->route('home', app()->getLocale());

    }

    public function guardar1(Request $request) {
        // Procesa los datos del formulario 1
        // Devuelve una respuesta JSON
        $date = Carbon::now();
        DB::table('PRVusuarios')->where('ID', $request->id)->update(['usuario'=>$request->usuario,'fecha_modificacion'=>$date]);
        return response()->json('Usuario Actualizado');
    }
    public function guardar2(Request $request) {
        // Procesa los datos del formulario 2
        // Devuelve una respuesta JSON
        $date = Carbon::now();
        DB::table('PRVusuarios')->where('ID', $request->id)->update(['rol'=>$request->rol,'fecha_modificacion'=>$date]);

        return response()->json('Rol Actualizado');
    }
    public function guardar3(Request $request) {
        // Procesa los datos del formulario 3
        // Devuelve una respuesta JSON
        $date = Carbon::now();
        DB::table('PRVusuarios')->where('ID', $request->id)->update(['RFC'=>$request->RFC,'fecha_modificacion'=>$date]);

        return response()->json('RFC Actualizado');
    }
    public function guardar4(Request $request) {
        // Procesa los datos del formulario 4
        // Devuelve una respuesta JSON
        $date = Carbon::now();
        DB::table('PRVusuarios')->where('ID', $request->id)->update(['clave'=>$request->clave,'fecha_modificacion'=>$date]);
        return response()->json('Contraseña Actualizada');
    }

    public function DeleteUser($language){
        session_start();
        $rol = $_SESSION['usuario']->rol;
        if($rol == "administrador"){
            //CODE
        return view('administracion.delete-usuario');
        }

        return redirect()->route('home', app()->getLocale());

    }


}
