@extends('adminlte::page')

@section('title', __('Perfil'))

@section('content_header')
<style>
    .profile-image-container {
  position: relative;
  display: inline-block;
}

.profile-image-overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: white;
  opacity: .8;
  text-align: center;
}
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
        <div class=" col-md-9 col-9"><h4><a href="#" onclick="goBack()" class="border rounded" >&nbsp;<i class="fas fa-arrow-left"></i>&nbsp;</a>&nbsp;&nbsp;&nbsp;{{__('Perfil')}}</h4></div>
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
@include('sweetalert::alert')
<div class="containter">
        <div class="row">
        <div class="col">
        <div class="card">
            <div class="card-body">
                <h4>{{__('Información General')}}</h4>
            <br>
            <form action="{{route('updateinfouser', app()->getLocale())}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group text-center">
                  <div class="profile-image-container">
                    <img src="{{$_SESSION['usuario']->imagen}}" style="max-width:150px" alt="Imagen de perfil" class="profile-image rounded-circle" id="profile-image">
                    <div class="profile-image-overlay">
                      <label for="input-profile-image" style="color:black;opacity:1;" class="btn ">{{__('Cambiar imagen')}}</label>
                      <input type="file"  id="input-profile-image" style="display: none;">
                      <input type="hidden" name="id" value="{{$_SESSION['usuario']->ID}}" >
                    </div>
                  </div>
                </div>
                <!-- Resto del formulario aquí -->
                <div class="form-group">
                    <label for="exampleFormControlInput1">{{__('Nombre')}}</label>
                    <input type="text" name="nombre" value="{{$_SESSION['usuario']->usuario}}" class="form-control" id="exampleFormControlInput1" placeholder="{{__('Nombre de la empresa')}}" pattern="[A-Za-zÁ-ÿ\s]+" required>
                  </div>
                {{-- <div class="form-group">
                    <label for="exampleFormControlInput1">{{__('Correo Electrónico')}}</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="{{__('nombre')}} @ {{__('ejemplo')}} .com" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlInput1">{{__('Número Telefónico')}}</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" pattern="[\+0-9]+.{0,}" placeholder="{{__('Celular o Fijo')}}" required maxlength="20">
                  </div> --}}
            </div>
        </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4>{{__('Datos de facturación')}}</h4><br>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">{{__('RFC (Número de Identificación Fiscal)')}}</label>
                        <input type="text" name="rfc" class="form-control" value="{{$_SESSION['usuario']->RFC}}" id="exampleFormControlInput1" pattern="[A-Za-z]{4}[0-9]{6}[A-Za-z0-9]{3}" placeholder="{{__('Inserte el RFC Emisor')}}" required>
                      </div>
                      {{-- <div class="form-group">
                        <label for="exampleFormControlInput1">{{__('Dirección')}}</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="{{__('Dirección de la empresa')}}" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlInput1">{{__('Codigo Postal')}}</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" pattern="[0-9]{5}" placeholder="{{__('Código Postal')}}" required>
                      </div> --}}
                      <center><button type="submit" class="btn btn-primary">{{__('Guardar')}}</button></center>
                </div>
            </div>
            </div>
        </form>
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
    document.addEventListener('DOMContentLoaded', () => {
      const profileImage = document.getElementById('profile-image');
      const inputProfileImage = document.getElementById('input-profile-image');

      inputProfileImage.addEventListener('change', (event) => {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = (e) => {
          profileImage.src = e.target.result;
        };

        if (file) {
          reader.readAsDataURL(file);
        }
      });
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

@stop
