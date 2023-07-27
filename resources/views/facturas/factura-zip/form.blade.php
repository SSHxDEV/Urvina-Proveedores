@extends('adminlte::page')
@section('usermenu_body')
<center>
    <b>RFC: {{$_SESSION['usuario']->RFC}}</b>
</center>
@stop
@section('title', __('Subir ZIP'))

@section('content_header')
<?php


use PhpCfdi\SatEstadoCfdi\Soap\SoapConsumerClient;
use PhpCfdi\SatEstadoCfdi\Soap\SoapClientFactory;
use PhpCfdi\SatEstadoCfdi\Consumer;

?>
<style>
    .drop-area {
      width: 300px;
      height: 200px;
      border: 2px dashed #ccc;
      line-height: 200px;
      text-align: center;
      font-size: 1.2em;
      margin-bottom: 10px;
      cursor: pointer;
      position: relative;
      overflow: hidden;
    }

    .loading {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    }
    .fadeOut {
        opacity: 0;
        transition: opacity 0.5s ease;
        }

    .loading img {

    height: 250px;
    margin-bottom: 10px;
    }

    /* Clase para ocultar el elemento */
    .hidden {
        display: none;
    }

    /* Animación de los puntos "Cargando..." */


.loading b {
    font-size: 20px;

    /* Estilos para el texto "Cargando..." */
    color: #00274c; /* Color azul profundo */
    font-weight: bold;
    text-shadow: 0 0 8px #00a4ff; /* Sombra de color azul luminoso */
    background: linear-gradient(90deg, #00a4ff, #00274c); /* Gradiente de color azul luminoso a azul profundo */
    background-clip: text; /* Hace que el gradiente solo aplique al texto */
    -webkit-background-clip: text; /* Compatible con navegadores basados en WebKit */
    color: transparent; /* Hace que el color del texto sea transparente para mostrar el gradiente */
}

    .drop-area input {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      opacity: 0;
      cursor: pointer;
    }

    .drop-area.dragover {
      background-color: #e1e1e1;
    }
    .drop-area .text{
        font-size: .65em;
    }


  </style>
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
    @include('sweetalert::alert')
    <div class="row">
        <div class=" col-md-9 col-9"><h4><a href="#" onclick="goBack()" class="border rounded" >&nbsp;<i class="fas fa-arrow-left"></i>&nbsp;</a>&nbsp;&nbsp;&nbsp;{{__('Subir Factura')}}</h4></div>
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

<div class="container">
    <div class="card buttons">
        <div class="card-body">
            <center><h3><b>Seleccione su receptor</b></h3></center>
    <div class="row justify-content-md-center ">

        <div class="col-6">
            <center>
            <a onclick="selectValue('USI970814616')" class="btn btn-dark btn-lg" >
                <img src="/logo/grupo_urvina_logo.png" class="rounded" alt="" style="padding:10px;width:150px;background-color:white">
            </a>
            </center>
        </div>
        <div class="col-6">
            <center>
            <a onclick="selectValue('CNE980528JV6')" class="btn btn-dark btn-lg" >
                <img src="/logo/logo_coeli.png" class="rounded" alt="" style="padding:10px;width:150px;background-color:white">
            </a>
            </center>
        </div>

    </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <form id="myForm" class="hidden" method="post" action="{{route('upload-zip', app()->getLocale())}}" enctype="multipart/form-data">
                    @csrf
                <div class="card-header">
                    {{__('Formulario de Subida de ZIP')}}
                </div>
                <div class="card-body">
                    <div class="row justify-content-md-center">
                        <div class="col-4">
                            <div class="drop-area"  for="file-input-zip" id="drop-area-zip" onclick="triggerFileInputZip()" ondragover="handleDragOver(event)" ondrop="handleFileDrop(event, 'file-input-zip')">
                                {{__('Arrastra y suelta aquí el ZIP')}}
                              </div>
                              <input type="file" name="zipFile" id="file-input-zip" accept=".zip" style="display: none;" required>
                              <input type="hidden" id="hiddenInput" name="receptor">
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <center><input class="btn btn-success" type="submit" value="{{__("Enviar Factura")}}" onclick="showLoading()"></center>
                </div>
            </form>
            </div>
            <div id="loading" class="loading hidden">
                <img class="rounded" src="/img/loading.gif" alt="Cargando...">
                <b style="margin-top:-50px"><span id="loading-text"></span></b>
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
    function selectValue(value) {
  document.getElementById('hiddenInput').value = value;
  hideButtons();
  showForm();
}

function hideButtons() {
  const buttons = document.getElementsByClassName('buttons')[0];
  buttons.classList.add('fadeOut');
  setTimeout( function() {buttons.style.display = 'none';},500);
}

function showForm() {
  const form = document.getElementById('myForm');
  form.classList.remove('hidden');
}

</script>
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
    function showLoading() {
    // Muestra la pantalla de carga
    var loadingElement = document.getElementById('loading');
    loadingElement.classList.remove('hidden');

    // Obtén el elemento del texto "Cargando..."
    var textElement = document.getElementById('loading-text');
    var text = {{__("Cargando...")}}; // Texto a mostrar
    var index = 0; // Índice para seguir la progresión del texto

    // Simula la escritura progresiva del texto con un intervalo de tiempo de 200ms entre cada punto
    var interval = setInterval(function() {
        if (index <= text.length) {
            textElement.innerText = text.slice(0, index);
            index++;
        } else {
            clearInterval(interval);
            // Envía el formulario (simulado)
            document.getElementById('myForm').submit();
        }
    }, 20000);
}


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
        function handleDragOver(event) {
          event.preventDefault();
          event.dataTransfer.dropEffect = 'copy';
          event.target.classList.add('dragover');
        }

        function handleFileDrop(event, fileInputId) {
          event.preventDefault();
          event.target.classList.remove('dragover');

          var file = event.dataTransfer.files[0];
          var fileInput = document.getElementById(fileInputId);

          // Verificar el tipo de archivo
          if ((fileInputId === 'file-input-zip' || fileInputId === 'file-input-zip') && file.type === 'application/zip') {
            fileInput.files = event.dataTransfer.files;
            fileInput.style.display = 'block';
          } else {
            alert('Por favor, selecciona un archivo válido.');
          }
        }

        function triggerFileInputZip(event, fileInputId) {
        var timeout;
        clearTimeout(timeout); // Reinicia el temporizador si el evento onchange se dispara nuevamente antes de que se complete el tiempo de espera
        document.getElementById('file-input-zip').click();

        timeout = setTimeout(function() {
            var inputElement = document.getElementById('file-input-zip');

            if (inputElement.files.length > 0) {
            inputElement.style.display = 'block';
            } else {
            inputElement.style.display = 'none';
            }
        }, 2000); // Tiempo de espera en milisegundos (1 segundo en este caso)
        }


      </script>

@stop
