@extends('layouts.app')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
<style>
    .box {
        background-color:#0F1934;
        border-radius: 0% 5% 5% 0%;
        -webkit-transition: background-color 2s ease-out;
  -moz-transition: background-color 2s ease-out;
  -o-transition: background-color 2s ease-out;
  transition: background-color 2s ease-out;
    }
h2{
    font-family: 'Quicksand', sans-serif;
}
    .box:hover {
  background-color: #0E7E2D;
  cursor: pointer;
}
.titlebann{
 display:none;
}
@media (max-width:320px)  { /* smartphones, iPhone, portrait 480x320 phones */
#logincart{
    margin-left:-20px;
}
.mhead{
    margin-top:5%;
    margin-bottom:20%;
}
.banner{
    display:none;
}
.titlebann{
 display:block;
}
}
@media (max-width:481px)  { /* portrait e-readers (Nook/Kindle), smaller tablets @ 600 or @ 640 wide. */
    #logincart{
    margin-left:-20px;
}
.mhead{

    margin-top:5%;
    margin-bottom:20%;
}
.banner{
    display:none;
}
.titlebann{
 display:block;
}

 }


</style>
<div class="container" >


    <div class="row" display="flex" height="100%" style="margin-right:-10%">
    <div class="col-sm-6 banner"  style="align-items: center; y justify-content: center; margin-right:-10%;background-image: url('/img/1260.jpg');background-position: center;border-radius: 5% 0% 0% 5%;">
        <div class="container" style="align-items: center; y justify-content: center; margin-bottom:-10%; margin-right:-10%; margin-left:-6%;">
            <div class="card mhead" >
                <div class="card-body bg-dark text-white">
                    <center><h2>{{__('PORTAL DE PROVEEDORES')}}</h2></center>
                </div>
            </div>
        </div>

    </div>
    <div class="col-sm-6 box" style="">
        <center>
        <div style="">
        <img src="/logo/grupo_urvina_logo.png" class="rounded" alt="" style="padding:10px;margin-top:50px;width:150px;background-color:white"> <img src="/logo/logo_coeli.png" class="rounded" alt="" style="padding:10px;margin-top:50px;width:150px;background-color:white">
        </div>
    </center>

        <div class="row justify-content-center" style="margin-top:-80px">
            <div class="col" >
                <div class="card" id="logincart" style="margin-top:20%;margin-bottom:20%">
                    <div class="card-header bg-dark text-white" ><center><b>{{ __('Acceso al sistema') }}</b><b class="titlebann"> {{__("Portal de Proveedores")}}</b></center></div>


                    <div class="card-body" >
                        <form method="POST" action="{{route('validar-registro', app()->getLocale())}}">
                            @csrf
                            <center>
                            <div class="row mb-3">

                                <label for="usuario" class="col-sm-4 col-form-label text-md-end">{{ __('Usuario') }}</label>

                                <div class="col-sm-6">
                                    <input id="usuario" type="usuario" class="form-control @if(isset($msg))('email') is-invalid @endif" name="usuario" value="{{ old('usuario') }}" required autocomplete="email" autofocus>

                                    @error('usuario')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-sm-4 col-form-label ">{{ __('Contraseña') }}</label>

                                <div class="col-sm-6">
                                    <input id="password" type="password" class="form-control @if(isset($msg)) is-invalid @endif" name="password" required autocomplete="current-password">

                                    @if(isset($msg))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $msg }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Recuerdame') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-12 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Entrar') }}
                                    </button>
                                </center>


                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
@endsection
