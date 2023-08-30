@extends('adminlte::page')

@section('title', __('Información de Factura'))

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

/* Estilo para el contenido del PDF */
#pdfContainer {
    max-height: calc(100% - 40px); /* Resta el espacio para el botón de cerrar y el padding del modal */
    overflow-y: auto;
}

.grow {
            transition: 1s ease;
        }

        .grow:hover {

            -webkit-transform: scale(1.2);
            -ms-transform: scale(1.2);
            transform: scale(1.2);
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
        <div class=" col-md-9 col-9"><h4><a href="#" onclick="goBack()" class="border rounded" >&nbsp;<i class="fas fa-arrow-left"></i>&nbsp;</a>&nbsp;&nbsp;&nbsp;{{__('Información de Factura')}}</h4></div>
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
    @include('sweetalert::alert')
    <div class="row">
        <div class="col-12">
            <div class="card bg-dark">
                <div class="card-body">
                    <center>
                        <h5><b>{{__('Factura')}}:</b>  {{$data[0]->factura}}</h5>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12"><div class="card"><div class="card-header bg-dark">{{__('Información General')}}</div>
        <div class="card-body">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span style="width:85px" class="input-group-text"><b>UUID</b> </span>
                </div>
                <input type="text" class="form-control" value="{{$data[0]->uuid}}" disabled>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span style="width:85px" class="input-group-text"><b>{{__('Emisor')}}</b> </span>
                    </div>
                    <input type="text" class="form-control" value="{{$data[0]->emisor}}" disabled>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span style="width:85px" class="input-group-text"><b>{{__('Receptor')}}</b> </span>
                        </div>
                        <input type="text" class="form-control" value="{{$data[0]->receptor}}" disabled>
                        </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span style="width:85px" class="input-group-text"><b>{{__('Estado')}}</b> </span>
                        </div>
                        <input type="text" class="form-control" value="{{$data[0]->estado}}" disabled>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span style="width:85px" class="input-group-text"><b>{{__('Sello')}}</b> </span>
                            </div>
                            <input type="text" class="form-control" value="{{$data[0]->sello}}" disabled>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span style="width:85px" class="input-group-text"><b>{{__('Total')}}</b> </span>
                                </div>
                                <input type="text" class="form-control" value="$ {{$data[0]->total}}" disabled>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                    <span style="width:85px" class="input-group-text"><b>{{__('Ingreso')}}</b> </span>
                                    </div>
                                    <input type="text" class="form-control" value="{{$data[0]->IFecha}}" disabled>
                                    </div>

                                    <center> <a class="btn btn-secondary" href="https://verificacfdi.facturaelectronica.sat.gob.mx/default.aspx?&id={{$data[0]->uuid}}&re={{$data[0]->emisor}}&rr=USI970814616&tt={{$data[0]->total}}&fe={{$data[0]->sello}}" target="_blank">  {{__('Validez en SAT')}} </a></center>
        </div>
        </div></div>

        <div class="col-md-6 col-sm-12"><div class="card"><div class="card-header @if($data[0]->descripcion=="Subido Exitosamente") bg-success @else bg-warning @endif"><b>{{__('Estado')}}:</b> {{__($data[0]->descripcion)}}</div>
        <div class="card-body">
            <div style="padding:20px;background-color: RGBA( 0 , 255 , 0 , 0.2 );" class="row">
                <div class="col-4"><img class="grow" src="/icons/xml.png" width="60px" alt=""></div>
                <div class="col-8"><b>{{__('Documento XML de Factura')}}</b><br><a class="btn btn-primary btn-xml" data-rfc="{{$factura->receptor}}" data-file="{{$factura->factura}}"> {{__('Visualizar XML')}}</a></div>
            </div>

            {{-- UTILIZAR CODIGO EN CASO DE USAR UN PDF APARTE DEL SELLADO
                @if ($data[0]->PDF == "")
            <hr>
            <div style="padding:20px; background-color:RGBA( 255 , 255 , 0 , 0.3 );">
                <form action="{{route('upload-pdf', app()->getLocale())}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="exampleFormControlFile1">Suba su factura en pdf</label>
                      <input type="file" accept=".pdf" name="PDF" class="form-control-file">
                      <input type="hidden" name="receptor" class="form-control-file">
                      <input type="hidden" name="factura" class="form-control-file" value="{{$data[0]->ID}}">
                    </div>
                    <center><button class="btn btn-primary" type="submit"> Subir PDF </button></center>
                  </form>
            </div>

            @else
            <hr>
            <div style="padding:20px;background-color: RGBA( 0 , 255 , 0 , 0.2 );" class="row">

                <div class="col-4"><a></a><img class="grow" src="/icons/pdf.png" width="60px" alt=""></div>
                <div class="col-8"><b>Documento PDF de Factura</b><br><a class="btn btn-primary btn-file" data-file="{{$data[0]->PDF}}.pdf"> Ver Documento </a> <a target="_blank" class="btn btn-success" href="/facturas/{{$_SESSION['usuario']->RFC}}/{{$data[0]->PDF}}.pdf" download> Descargar </a></div>
            </div>

            @endif --}}
            @if ($data[0]->PDFsello == "")
            <hr>
            <div style="padding:20px; background-color:RGBA( 255 , 255 , 0 , 0.3 );">
                <form action="{{route('upload-pdf', app()->getLocale())}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="exampleFormControlFile1">{{__('Suba su factura sellada por almacen')}}</label>
                      <input type="file" accept=".pdf" name="PDFsello" class="form-control-file">
                      <input type="hidden" name="receptor" class="form-control-file">
                      <input type="hidden" name="factura" class="form-control-file" value="{{$data[0]->ID}}">
                    </div>
                    <center><button class="btn btn-primary" type="submit"> {{__('Subir PDF')}} </button></center>
                  </form>
            </div>


            @else
            <hr>
            <div style="padding:20px;background-color: RGBA( 0 , 255 , 0 , 0.2 );" class="row">

                <div class="col-4"><a></a><img class="grow" src="/icons/pdf.png" width="60px" alt=""></div>
                <div class="col-8"><b>{{__('Documento PDF de Factura')}}</b><br><a class="btn btn-primary btn-file" onclick="cargarPDF('{{$factura->receptor}}/{{$_SESSION['usuario']->RFC}}/{{$factura->PDFsello}}.pdf')" > {{__('Visualizar PDF')}} </a> </div>
            </div>

            @endif





        </div>
        </div></div>
    </div>

    <!-- Modal para mostrar el archivo PDF-->
<div class="modal" id="fileModal" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-xl " role="document">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Vista previa del archivo PDF')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <center>
                <div id="pdfContainer">
                    <!-- Aquí se mostrará el contenido del PDF -->
                </div>
                </center>

            </div>
            <div class="modal-footer">
                <a class="btn btn-success" id="downloadLink" href="" download>{{__('Descargar PDF')}}</a>
            </div>
        </div>
    </div>
</div>

    <!-- Modal para mostrar el archivo XML -->
    <div class="modal" id="xmlModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Vista previa del archivo XML')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <div id="pdfContainer">
                        <!-- Aquí se mostrará el contenido del PDF -->
                    </div>

                </div>
                <div class="modal-footer">
                    <a class="btn btn-success" id="downloadXML" href="" download>{{__('Descargar XML')}}</a>
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

    </div>
</div>
</center>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">
    <link href="https://cdn.jsdelivr.net/npm/pdfjs-dist@3.8.162/web/pdf_viewer.min.css" rel="stylesheet">
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@3.8.162/build/pdf.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
<script>
    // Función para cargar y visualizar el PDF seleccionado en el contenedor
    function cargarPDF(rutaArchivo) {
        var fileName = $(this).data("file");
        var fileRFC = $(this).data("rfc");
        var url = '{{route('docs-view', app()->getLocale())}}?archivo=' + encodeURIComponent(rutaArchivo);

        // Cargar el PDF usando PDF.js
        pdfjsLib.getDocument(url).promise.then(function(pdf) {
            // Cargar la primera página del PDF
            pdf.getPage(1).then(function(page) {
                var canvas = document.createElement('canvas');
                var pdfContainer = document.getElementById('pdfContainer');
                pdfContainer.innerHTML = '';
                pdfContainer.appendChild(canvas);

                // Escalar el contenido del PDF para que se ajuste al tamaño del contenedor
                var viewport = page.getViewport({ scale: 1.5 });
                var context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                var renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };

                // Renderizar la página del PDF en el lienzo
                page.render(renderContext);

                // Mostrar el enlace de descarga cuando se cargue el PDF
                var downloadLink = document.getElementById('downloadLink');
                        downloadLink.href = url; // Obtener la URL de descarga del PDF desde los datos almacenados
                        downloadLink.innerHTML = 'Descargar PDF'; // Establecer el texto del enlace
                        downloadLink.style.display = 'block';
                        downloadLink.download = "{{$data[0]->PDFsello}}.pdf";

            });
        });
    }
</script>

<script>
    $(document).ready(function() {
        $(".btn-file").on("click", function() {
            var fileName = $(this).data("file");
            // Reemplaza "ruta_archivos/" por la ruta real de tus archivos
           // var fileURL = "/facturas/{{$_SESSION['usuario']->RFC}}/" + fileName;

            // Abre el modal y muestra el archivo dentro de un iframe
            // $("#fileModal .modal-body").html('<iframe type="text/plain" src="' + fileURL + '" width="100%" height="500px"></iframe>');
            $("#fileModal").modal("show");
        });
    });
    </script>
    <script>
        $(document).ready(function() {
            $(".btn-xml").on("click", function() {
                var fileName = $(this).data("file");
                var fileRFC = $(this).data("rfc");
                // Reemplaza "ruta_archivos/" por la ruta real de tus archivos

                var decodedFileURL= decodeURIComponent(fileName);

                console.log(fileRFC);

                // Abre el modal y muestra el archivo dentro de un iframe
                 $("#xmlModal .modal-body").html('<iframe type="text/plain" src="' + decodedFileURL + '" width="100%" height="500px"></iframe>');
                 // Mostrar el enlace de descarga cuando se cargue el PDF
                var downloadLink = document.getElementById('downloadXML');
                        downloadLink.href = decodedFileURL; // Obtener la URL de descarga del PDF desde los datos almacenados
                        downloadLink.innerHTML = 'Descargar XML'; // Establecer el texto del enlace
                        downloadLink.style.display = 'block';
                        downloadLink.download = "{{$data[0]->factura}}.xml";
                $("#xmlModal").modal("show");
            });
        });
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
