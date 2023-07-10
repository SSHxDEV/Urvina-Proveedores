<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{

    public function login(Request $request){
        if(isset($_SESSION)){
            return redirect()->route('home', app()->getLocale());
        }else{
        //Validar Datos
        $msg = "";
        $user = "Usuario";
        $pswd= "USIsis2023@";
        // $user = DB::select(
        //     "EXEC spAccesoApp :user, :password",
        //     [
        //         "user" => $request->usuario,
        //         "password" => $request->password,
        //     ]
        // );
        if($user != $request->usuario ){
            $msg = "Usuario o Contraseña Incorrecta";
            return view('login')->with('msg', $msg);
        }
        if($pswd != $request->password){
            $msg = "Contraseña Incorrecta";
            return view('login')->with('msg', $msg);
        }
        else{
            session_start();
            // $_SESSION['usuario'] = $user[0];
            $_SESSION['usuario'] = $user;
            return redirect()->route('home', app()->getLocale())->with('usuario', $user);
        }
    }

        //$user[0]->Nombre
    }

    public function logout(Request $request){
        session_start();
        unset($_SESSION['usuario']);
        session_destroy();
        return redirect()->route('login', app()->getLocale());
    }

}
