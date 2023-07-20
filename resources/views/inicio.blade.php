@extends('adminlte::page')

@if($_SESSION['usuario']->RFC != "")
@section('usermenu_body')
<center>
    <b>RFC: {{$_SESSION['usuario']->RFC}}</b>
</center>
@stop
@endif

@section('title', __('Inicio'))

@section('content_header')
<style>
    #folder-icon:hover {

  cursor: pointer; /* Opcionalmente, cambia el cursor al pasar sobre el icono */
}
    .jumpin {
  animation-duration: 3s;
  animation-name: slidein;

  animation-direction: alternate;
}
.button {
  transition: transform 0.3s;
  transition: box-shadow 0.3s;
}

.button:hover {
  transform: scale(1.1); /* Cambia el factor de escala según tus necesidades */
  box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5); /* Cambia los valores según tus necesidades */
}
.grow {
            transition: 1s ease;
        }

        .grow:hover {

            -webkit-transform: scale(1.1);
            -ms-transform: scale(1.1);
            transform: scale(1.1);
            transition: 1s ease;
            z-index: 4;
        }

        a {
            color: inherit;
            /* blue colors for links too */
            text-decoration: inherit;
            /* no underline */
        }

@keyframes slidein {
  from {
    margin-left: 100%;
    width: 300%;
  }
  to {
    margin-left: 0%;
    width: 100%;
  }
}
@media (min-width:320px)  { /* smartphones, iPhone, portrait 480x320 phones */
            .img-card-top{
                height:11rem;
                margin-top:10px;
                max-width:14.5rem;

            }
            .card{
                width: 15rem;
                height:21rem;

            }
            .bandera{
                width:30px;
            }
        }
        @media (min-width:481px)  { /* portrait e-readers (Nook/Kindle), smaller tablets @ 600 or @ 640 wide. */
            .img-card-top{
                height:10rem;
                max-width:9.5rem;
                margin-top:10px;

            }
            .card{
                width: 10rem;
                height:23rem;
            }
            .bandera{
                width:30px;
            }
        }
        @media (min-width:641px)  { /* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones */
            .img-card-top{
                height:11rem;
                margin-top:10px;
                max-width:9.5rem;

            }
            .card{
                width: 10rem;
                height:23rem;

            }
            .bandera{
                width:45px;
            }
        }
        @media (min-width:961px)  { /* tablet, landscape iPad, lo-res laptops ands desktops */
            .img-card-top{
                height:11rem;
                max-width:14.5rem;
                margin-top:10px;

            }
            .card{
                width: 15rem;
                height:21rem;

            }
            .bandera{
                width:45px;
            }
        }
        @media (min-width:1025px) { /* big landscape tablets, laptops, and desktops */
            .img-card-top{
                height:11rem;
                margin-top:10px;

            }
            .card{
                width: 15rem;
                height:21rem;

            }
            .bandera{
                width:45px;
            }
        }
        @media (min-width:1281px) { /* hi-res laptops and desktops */
            .img-card-top{
                height:11rem;
                margin-top:10px

            }
            .card{
                width: 15rem;
                height:21rem;

            }
            .bandera{
                width:45px;
            }
        }
</style>

<div class="container">
    <div class="row">
        <div class=" col-md-9 col-9"><h4><a href="#" onclick="goBack()" class="border rounded" >&nbsp;<i class="fas fa-arrow-left"></i>&nbsp;</a>&nbsp;&nbsp;&nbsp;{{__('Inicio')}}</h4></div>
        <div class="col-md-3 col-3 ml-auto">
            <a href="{{route(Route::currentRouteName(),'en')}}">
                <img src="/icons/en.svg" class="bandera" alt="EN">
              </a>
              <a href="{{route(Route::currentRouteName(), 'es' )}}">
                <img src="/icons/es.svg" class="bandera"  alt="ES">
              </a>

          </div>


    </div>
</div>

    <br>

@stop

@section('content')


<div id="hi" class="jumbotron jumpin">
    <h1 class="display-4">{{__("¡Bienvenido de vuelta")}} <small><b>{{$_SESSION['usuario']->usuario}}</b></small>!</h1>
    <p class="lead">{{__("Te damos la bienvenida a la actualización del Portal Urvina. Sientase libre de utilizar el portal y subir sus facturas...")}}</p>

  </div>
  <div class="">
            </div>
            <div class="container-fluid"><center>
            <div class="row justify-content-md-center" >
                <div class="col-md-4 col-sm-12">
                    <a href="">
                    <div class="card button" style="height:200px; width:200px">
                        <div class="card-header">
                            <center>{{__('Consultar Facturas')}}</center>
                        </div>
                        <div class="card-body">
                            <center><span id="folder-icon" class="far fa-folder fa-5x"></span></center>
                            {{-- <i class="far fa-folder-open"></i> --}}
                        </div>
                    </div>
                   </a>
                </div>
                <div class="col-md-4 col-sm-12">
                    <a href="{{route('factura-form', app()->getLocale())}}">
                    <div class="card button" style="height:200px; width:200px">
                        <div class="card-header">
                            <center>{{__('Subir Factura')}}</center>
                        </div>
                        <div class="card-body">
                            <center><i class="fas fa-upload fa-2x"></i>&nbsp;&nbsp;<i class="far fa-file fa-5x"></i></center>
                        </div>
                    </div>
                   </a>
                </div>
                <div class="col-md-4 col-sm-12">
                    <a href="{{route('factura-zip', app()->getLocale())}}">
                    <div class="card button" style="height:200px; width:200px">
                        <div class="card-header">
                            <center>{{__('Subir .ZIP')}}</center>
                        </div>
                        <div class="card-body">
                            <center><i class="fas fa-upload fa-2x"></i>&nbsp;&nbsp;<i class="far fa-file-archive fa-5x"></i></center>
                        </div>
                    </div>
                   </a>
                </div>


            </div>
        </center>
        </div>




@stop

@section('right-sidebar')
<div class="container">
    <center>
        <br>
<h3>{{__('Contacto')}}</h3>
<br><br>
<div class="card">


        </div>
    </div>
</div>
</center>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    const icono = document.getElementById('folder-icon');
icono.addEventListener('mouseover', function() {
  icono.classList.remove('fa-folder'); // Quita la clase actual del icono
  icono.classList.add('fa-folder-open'); // Agrega la nueva clase para cambiar al nuevo icono
});

icono.addEventListener('mouseout', function() {
  icono.classList.remove('fa-folder-open'); // Quita la clase del nuevo icono
  icono.classList.add('fa-folder'); // Agrega la clase original para restaurar el icono inicial
});

</script>
<script>

    setTimeout(function() { $('#hi').fadeOut('fast'); }, 10000); // <-- time in milliseconds

    var timeoutID;
    var cierraSesionIrLogeo = "{{route('salir', app()->getLocale())}}";

    function setup() {
      this.addEventListener("mousemove", resetTimer, false);
      this.addEventListener("mousedown", resetTimer, false);
      this.addEventListener("keypress", resetTimer, false);
      this.addEventListener("DOMMouseScroll", resetTimer, false);
      this.addEventListener("mousewheel", resetTimer, false);
      this.addEventListener("touchmove", resetTimer, false);
      this.addEventListener("MSPointerMove", resetTimer, false);

      startTimer();
    }
    setup();

    function startTimer() {
      // wait 2 seconds before calling goInactive
      timeoutID = window.setTimeout(goInactive, 600000);
    }

    function resetTimer(e) {
      window.clearTimeout(timeoutID);

      goActive();
    }

    function goInactive() {
      // do something
      // alert("inactivo");
      window.location=window.location=cierraSesionIrLogeo;
    }

    function goActive() {
      // do something

      startTimer();
    }
    </script>
     <script>
        // Barra de busqueda
        document.getElementById('search')
    .addEventListener('keyup', function(event) {
        if (event.code === 'Enter')
        {
            event.preventDefault();
            document.querySelector('form').submit();
        }
    });
    </script>

@stop
