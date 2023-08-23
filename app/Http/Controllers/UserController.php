<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function UpdateUser(){
        session_start();
        if(isset($_SESSION['usuario'])){
            if(isset($_SESSION['usuario'])){

            }
        return view('user.profile');
    }else {
        return redirect()->route('login', app()->getLocale());
    }

    }

    public function UpdateInfoUser(Request $request){
        session_start();
        if(isset($_SESSION['usuario'])){
            if(isset($_SESSION['usuario'])){
                $RFC = $request->rfc;
                $Nombre= $request->nombre;
                $ID = $request->id;
                if($_SESSION['usuario']->RFC != $RFC){
                    $_SESSION['usuario']->RFC = $RFC;
                }
                if($_SESSION['usuario']->usuario != $Nombre){
                    $_SESSION['usuario']->usuario = $Nombre;
                }
                DB::table('PRVusuarios')
                ->where('ID', $ID)
                ->update(['usuario' => $Nombre, 'RFC' => $RFC]);
                Alert::success(__('Actualizado correctamente.'), __('Se ha actualizado su Información de Usuario.'));
                return redirect()->back();
            }
        return view('user.profile');
    }else {
        return redirect()->route('login', app()->getLocale());
    }

    }
}
