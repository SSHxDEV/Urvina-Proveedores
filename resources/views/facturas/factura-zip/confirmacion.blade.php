@extends('adminlte::page')
@section('usermenu_body')
<center>
    <b>RFC: {{$_SESSION['usuario']->RFC}}</b>
</center>
@stop
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

          </div>
    </div>
</div>
    <br>
@stop

@section('content')

<div class="container">
    <div class="row justify-content-md-center">

        <div class="col-8">
            <div class="card ">
                <div class="card-body">
                    <center>
                    @if(count($archivos_xml)>0)
                    <h2 style="relative:relative; z-index:1">
                        {{-- {{__("¡Su")}} <i class="far fa-file-archive"></i> {{__("se ha subido con exito!")}} --}}
                        <i class="fas fa-exclamation-circle"></i> <b>{{__('Añada la siguiente informacion')}}</b>
                    </h2><br>
                    @else
                    <h2 style="relative:relative; z-index:1">
                        {{__("Su")}} <i class="far fa-file-archive"></i> {{__("no contiene facturas validas")}}
                    </h2><br>
                    @endif
                    @if(count($archivos_xml)>0)
                    <div class="card  " >
                        <div class="card-header bg-warning"> <i class="fas fa-exclamation-circle fa-lg"></i> <h5>{{__("Ingrese orden(es) de compra")}}</h5></div>
                        <div class="card-body">
                            <form method="post" action="{{route('zip-voc', app()->getLocale())}}">
                                @csrf
                            @foreach ($archivos_OC as $OC)
                            <hr>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-8 col-form-label"><i class="fas fa-circle" style="color:#18ec1b"></i>&nbsp;  {{$OC["nombre"]}} <br></label>
                                <div class="col-sm-4">
                                  <input type="text" name="{{ "OrdenCompra" . $OC["id"]}}" value="" class="form-control" id="inputPassword" placeholder="{{__('Orden de compra')}}" required>
                                </div>
                              </div>
                              <hr>

                            @endforeach
                            <button class="btn btn-success" type="submit"> {{__('Comprobar Facturas')}} </button>
                        </form>

                        </div>

                    </div><br>
                    <div class="card  " >
                        <div class="card-header bg-success text-white"> <i class="fas fa-check-circle fa-lg"></i> <h5>{{__("Archivos Subidos")}}</h5></div>
                        <div class="card-body">
                            @foreach ($archivos_xml as $xml)
                            <i class="fas fa-check" style="color:#18ec1b"></i>&nbsp;&nbsp;&nbsp;<i class="far fa-file-code"></i>  {{$xml}} <br>
                            @endforeach
                            @foreach ($archivos_pdf as $pdf)
                            <i class="fas fa-check" style="color:#18ec1b"></i>&nbsp;&nbsp;&nbsp;<i class="fas fa-file-pdf"></i>   {{$pdf}} <br>
                            @endforeach
                        </div>

                    </div><br>
                    @endif
                    @if(count($archivos_rechazados)>0)
                    <div class="card">
                        <div class="card-header bg-danger text-white"><i class="fas fa-times-circle fa-lg"></i> <h5>{{__("Archivos Rechazados")}}</h5></div>
                        <div class="card-body">
                            @foreach ($archivos_rechazados as $rechazados)
                            <i class="fas fa-times" style="color:#e10531"></i>  {{$rechazados["nombre"]}} : {{__($rechazados["razon"])}} <br>
                            <hr>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    </center>

                </div>

            </div>
        </div>

    </div>
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
