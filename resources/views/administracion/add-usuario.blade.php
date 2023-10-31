@extends('adminlte::page')

@section('title', __('Agregar Usuario'))

@section('content_header')


<style>
    .invalid {
        border: 1px solid red;
    }
    .valid {
        border: 1px solid green;
    }
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
        <div class=" col-md-9 col-9"><h4><a href="#" onclick="goBack()" class="border rounded" >&nbsp;<i class="fas fa-arrow-left"></i>&nbsp;</a>&nbsp;&nbsp;&nbsp;{{__('Agregar Usuario')}}</h4></div>
        <div class="col-md-3 col-3 ml-auto">


          </div>


    </div>
</div>

    <br>

@stop

@section('content')
@include('sweetalert::alert')
<div class="containter">
        <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-body">

            <form action="{{route('add-usuario', app()->getLocale())}}" method="POST">
                <!-- Campos del formulario 1 -->

                @csrf

                <!-- Resto del formulario aquí -->
                <div class="form-group">
                    <label for="exampleFormControlInput1">{{__('Nombre')}}</label>
                    <input type="text" name="usuario" value="" class="form-control" id="exampleFormControlInput1" placeholder="{{__('Nombre de la empresa')}}" pattern="[A-Za-zÁ-ÿ\s]+" required>
                  </div>

                  <div>
                  <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Rol de Usuario</label>
                  <select class="custom-select my-1 mr-sm-2" name="rol" id="inlineFormCustomSelectPref" required>
                    <option >Seleccione un Rol</option>
                    <option value="proveedor">Proveedor</option>
                    <option value="supervisor">Supervisior</option>
                    <option value="administrador">Administrador</option>
                  </select>
                </div>
                  <br>
                  <div class="form-group">
                    <label for="exampleFormControlInput1">{{__('RFC (Número de Identificación Fiscal)')}}</label>
                    <input type="text" name="rfc" class="form-control" value="" id="exampleFormControlInput1"  placeholder="{{__('Inserte el RFC Emisor')}}" required >
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="exampleFormControlInput1">{{__('Contraseña ')}}</label>
                    <input type="text" class="form-control" value="" id="contrasenaNueva"  placeholder="{{__('Inserte la nueva contraseña')}}" required pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$">
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlInput1">{{__('Confirmar Contraseña')}}</label>
                    <input type="text" name="clave" class="form-control" value="" id="confirmarContrasena" placeholder="{{__('Confirme su contraseña')}}" required pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$">
                  </div>
  <center>
    <button type="submit" class="btn btn-success">Guardar Usuario</button>
  </center>
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
