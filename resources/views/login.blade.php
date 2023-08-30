@extends('layouts.app')

@section('content')
@include('sweetalert::alert')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
<style>

.area{
    background: #4e54c8;
    background: -webkit-linear-gradient(to left, #8f94fb, #4e54c8);
    width: 100%;
    height:100vh;


}

.circles{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.circles li{
    position: absolute;
    display: block;
    list-style: none;
    width: 20px;
    height: 20px;
    background: rgba(255, 255, 255, 0.2);
    animation: animate 25s linear infinite;
    bottom: -150px;

}

.circles li:nth-child(1){
    left: 25%;
    width: 80px;
    height: 80px;
    animation-delay: 0s;
}


.circles li:nth-child(2){
    left: 10%;
    width: 20px;
    height: 20px;
    animation-delay: 2s;
    animation-duration: 12s;
}

.circles li:nth-child(3){
    left: 70%;
    width: 20px;
    height: 20px;
    animation-delay: 4s;
}

.circles li:nth-child(4){
    left: 40%;
    width: 60px;
    height: 60px;
    animation-delay: 0s;
    animation-duration: 18s;
}

.circles li:nth-child(5){
    left: 65%;
    width: 20px;
    height: 20px;
    animation-delay: 0s;
}

.circles li:nth-child(6){
    left: 75%;
    width: 110px;
    height: 110px;
    animation-delay: 3s;
}

.circles li:nth-child(7){
    left: 35%;
    width: 150px;
    height: 150px;
    animation-delay: 7s;
}

.circles li:nth-child(8){
    left: 50%;
    width: 25px;
    height: 25px;
    animation-delay: 15s;
    animation-duration: 45s;
}

.circles li:nth-child(9){
    left: 20%;
    width: 15px;
    height: 15px;
    animation-delay: 2s;
    animation-duration: 35s;
}

.circles li:nth-child(10){
    left: 85%;
    width: 150px;
    height: 150px;
    animation-delay: 0s;
    animation-duration: 11s;
}



@keyframes animate {

    0%{
        transform: translateY(0) rotate(0deg);
        opacity: 1;
        border-radius: 0;
    }

    100%{
        transform: translateY(-1000px) rotate(720deg);
        opacity: 0;
        border-radius: 50%;
    }

}
    .bg {
  animation:slide 3s ease-in-out infinite alternate;
  background-image: linear-gradient(-60deg, #0E7E2D 50%, #0F1934 50%);
  bottom:0;
  left:-50%;
  opacity:.5;
  position:fixed;
  right:-50%;
  top:0;
  z-index:-1;
}

.bg2 {
  animation-direction:alternate-reverse;
  animation-duration:4s;
}

.bg3 {
  animation-duration:5s;
}



@keyframes slide {
  0% {
    transform:translateX(-25%);
  }
  100% {
    transform:translateX(25%);
  }
}

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
<div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>
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
    <div class="col-sm-6 box " style="">
        <div class="">
            <ul class="circles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
            </ul>
    </div>
        <center>
        <div style="">
        <a href="https://urvina.com.mx/es/index.php" style="z-index:1" target="_blank"><img src="/logo/grupo_urvina_logo.png" class="rounded" alt="" style="padding:10px;margin-top:50px;width:150px;background-color:white"></a> <a target="_blank" href="https://urvina.com.mx/es/programa-coeli-mexicana-recuperacion-de-equipos-de-seguridad-ecologico.php"><img src="/logo/logo_coeli.png" class="rounded" alt="" style="padding:10px;margin-top:50px;width:150px;background-color:white"></a>
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
