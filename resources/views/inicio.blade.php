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
    .btn-circle.btn-xl {
    width: 70px;
    height: 70px;
    padding: 10px 16px;
    border-radius: 35px;
    font-size: 24px;
    line-height: 1.33;
}

.btn-circle {
    width: 30px;
    height: 30px;
    padding: 6px 0px;
    border-radius: 15px;
    text-align: center;
    font-size: 12px;
    line-height: 1.42857;
}

    #folder-icon:hover {

  cursor: pointer; /* Opcionalmente, cambia el cursor al pasar sobre el icono */
}
    .jumpin {
  animation-duration: 3s;
  animation-name: slidein;

  animation-direction: alternate;
}

#opciones1 {
    display: none;
}
#opciones2 {
    display: none;
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

            .bandera{
                width:45px;
            }
        }
        @media (min-width:1025px) { /* big landscape tablets, laptops, and desktops */
            .img-card-top{
                height:11rem;
                margin-top:10px;

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



            @if ($_SESSION['usuario']->rol == "proveedor")
            <div id="hi" class="jumbotron jumpin">
                <h1 class="display-4">{{__("¡Bienvenido de vuelta")}} <small><b>{{$_SESSION['usuario']->usuario}}</b></small>!</h1>
                <p class="lead">{{__("Te damos la bienvenida a la actualización del Portal Urvina. Sientase libre de utilizar el portal y subir sus facturas...")}}</p>

              </div>
            <div  class="container-fluid"><center>
            <div  class=" row justify-content-md-center"  >
                <div class="col-md-4 col-sm-12">
                    <a href="{{route('facturas-list', app()->getLocale())}}">
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
        @endif
        @if ($_SESSION['usuario']->rol == "finanzas")
        <div class="container-fluid"><center>

            <div class="row" id="monitor">
                <hr>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                    <span class="info-box-text">Proveedores Registrados</span>
                    <span class="info-box-number">{{$Totalp[0]->total}}</span>
                    </div>

                    </div>

                    </div>
                <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-tasks"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">Facturas en Revision</span>
                <span class="info-box-number">
                    {{$Totalfr[0]->total}}
                </span>
                </div>

                </div>

                </div>

                <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-times"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">Facturas Canceladas</span>
                <span class="info-box-number">{{$Totalfc[0]->total}}</span>
                </div>

                </div>

                </div>


                <div class="clearfix hidden-md-up"></div>
                <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">Facturas Aceptadas</span>
                <span class="info-box-number">{{$Totalfa[0]->total}}</span>
                </div>

                </div>

                </div>



                </div>
                <hr>
                <div id="opciones" class="row justify-content-md-center"


            <div class="col-6" >

                <a id="botonF">
                <div class="card button" style="height:200px; width:400px">
                <div class="card-header">
                    <center>{{__('Consultar Facturas')}}</center>
                </div>
                <div class="card-body">
                    <center><span id="folder-icon" class="far fa-folder fa-5x"></span></center>
                    {{-- <i class="far fa-folder-open"></i> --}}
                </div>
                </div>
                </a>




        <div class="col-6">
            <a id="botonP">
            <div class="card button" style="height:200px; width:400px">
                <div class="card-header">
                    <center>{{__('Consultar Proveedores')}}</center>
                </div>
                <div class="card-body">
                    <center><span id="folder-icon" class="far fa-folder fa-5x"></span></center>
                    {{-- <i class="far fa-folder-open"></i> --}}
                </div>
            </div>
           </a>
           </div>
    </div>
                <div class="row justify-content-center">
                    <button style="display:none" type="button" id="btngoback" class="btn btn-primary btn-lg btn-circle"><i class="fas fa-undo"></i>
                    </button>
                <div class="card buttons" id="opciones1">
                    <div class="card-body">
                        <center><h3><b>{{__('Consultar Facturas')}}</b></h3></center>
                <div class="row justify-content-md-center ">

                    <div class="col-6">
                        <center>
                        <a id="boton1" href="facturas-sup/USI" class="btn btn-dark btn-lg" >
                            <img src="/logo/grupo_urvina_logo.png" class="rounded btnM" alt="" style="padding:10px;background-color:white">
                        </a>
                        </center>
                    </div>
                    <div class="col-6">
                        <center>
                        <a id="boton2" href="facturas-sup/COELI" class="btn btn-dark btn-lg " >
                            <img src="/logo/logo_coeli.png" class="rounded btnM" alt="" style="padding:10px;background-color:white">
                        </a>
                        </center>
                    </div>

                </div>
                    </div>
                </div>
            </div>
                <div class="row justify-content-center">
                <div class="card buttons" id="opciones2">
                    <div class="card-body">
                        <center><h3><b>{{__('Consultar Proveedor')}}</b></h3></center>
                <div class="row justify-content-md-center ">

                    <div class="col-6">
                        <center>
                        <a href="proveedor-sup/USI" id="boton3" class="btn btn-dark btn-lg" >
                            <img src="/logo/grupo_urvina_logo.png" class="rounded btnM" alt="" style="padding:10px;background-color:white">
                        </a>
                        </center>
                    </div>
                    <div class="col-6">
                        <center>
                        <a href="proveedor-sup/COELI" id="boton4" class="btn btn-dark btn-lg " >
                            <img src="/logo/logo_coeli.png" class="rounded btnM" alt="" style="padding:10px;background-color:white">
                        </a>
                        </center>
                    </div>

                </div>
                    </div>
                </div>
            </div>
                <hr>

        </div>

        </center>
    </div>


        @endif




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
    <script>
        function goBack() {
          window.history.back();
        }
    </script>
    <script>
    document.getElementById("botonP").addEventListener("click", function() {
    document.getElementById("opciones2").style.display = "block";
    document.getElementById("btngoback").style.display = "block";
    document.getElementById("opciones1").style.display = "none";
    document.getElementById("opciones").style.display = "none";
    });
    document.getElementById("botonF").addEventListener("click", function() {
    document.getElementById("opciones1").style.display = "block";
    document.getElementById("btngoback").style.display = "block";
    document.getElementById("opciones2").style.display = "none";
    document.getElementById("opciones").style.display = "none";

    });

    document.getElementById("btngoback").addEventListener("click", function() {
    document.getElementById("opciones1").style.display = "none";
    document.getElementById("btngoback").style.display = "none";
    document.getElementById("opciones2").style.display = "none";
    document.getElementById("opciones").style.display = "block";

    });
    </script>

@stop
