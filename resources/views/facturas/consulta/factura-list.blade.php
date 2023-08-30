@extends('adminlte::page')

@section('title', __('Consulta de Facturas'))

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

/* Estilo para el contenido del PDF */
#pdfContainer {
    max-height: calc(100% - 40px); /* Resta el espacio para el botón de cerrar y el padding del modal */
    overflow-y: auto;
}

.button:hover {
  transform: scale(1.1); /* Cambia el factor de escala según tus necesidades */
  box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5); /* Cambia los valores según tus necesidades */
}

.single-line-cell {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
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
        <div class=" col-md-9 col-9"><h4><a href="#" onclick="goBack()" class="border rounded" >&nbsp;<i class="fas fa-arrow-left"></i>&nbsp;</a>&nbsp;&nbsp;&nbsp;{{__('Consulta de Facturas')}}</h4></div>
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
<div class="container">
        <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
    <table id="facturas-list" class="display table table-striped compact">
        <thead class="">
            <tr class="bg-success">
                <th class="align-top" style="width:100%">{{__('Factura')}}</th>
                <th class="align-top" style="width:100%">{{__('UUID')}}</th>
                <th class="align-top single-line-cell" style="width:100%">{{__('Orden de Compra')}}</th>
                <th class="align-top" style="width:100%">{{__('Subido')}}</th>
                <th  class="align-top single-line-cell" style="">{{__('Fecha factura')}}</th>
                <th  class="align-top" style="">{{__('Importe')}}</th>
                <th  class="align-top" style="">{{__('Moneda')}}</th>
                <th  class="align-top" style="">{{__('Estatus')}}</th>
                <th class="align-top" style="width:82px">{{__('Adjuntos')}}</th>
                <th  class="align-top" style="">{{__('Opciones')}}</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($data as $factura)
            <td rowspan="1" class="align-top single-line-cell" style="height:20px">{{$factura->factura}}</td>
            <td rowspan="1" class="align-top single-line-cell" style="height:20px">{{$factura->uuid}}</td>
            @if ($factura->OrdenCompra!="")
            <td style="height:20px" class="align-top">{{$factura->OrdenCompra}}</td>
            @else
            <td  style="height:20px" class="align-top"><button class="btn btn-warning btn-registro" data-id="{{$factura->ID}}" ><i class="fas fa-clipboard-check"></i> <b>{{__('Agregar')}}</b></button><small>{{$factura->errores}}</small></td>
            @endif

            <td style="height:20px" class="align-top single-line-cell">{{$factura->IFecha }}</td>
            <td>{{$factura->fechaFactura}}</td>
            <td><b>${{$factura->total}}</b></td>
            <td>{{$factura->moneda}}</td>

            @if($factura->descripcion == "Subido Exitosamente")
            <td style="height:20px; text-align: center" class="bg-success align-top single-line-cell"><b> {{__($factura->descripcion) }} </b></td>
            @else
            <td style="height:20px; text-align: center" class="bg-warning align-top single-line-cell"><b> {{__($factura->descripcion)}} </b></td>
            @endif
            <td rowspan="1" class="align-top" style="height:20px; width:82px">
                <a  class="btn-xml" data-rfc="{{$factura->receptor}}" data-file="{{$factura->factura}}" download><img class="grow"src="/icons/xml.png" alt="" width="40px"></a>
                {{-- UTILIZAR CODIGO EN CASO DE USAR UN PDF APARTE DEL SELLADO
                    @if ($factura->PDF != "")<a class="btn-file" data-file="{{$factura->PDF}}.pdf" href="#pdf"><img class="grow" src="/icons/pdf.png" width="40px" alt=""></a> @endif --}}
                @if ($factura->PDFsello != "")<a class="btn-file" onclick="cargarPDF('{{$factura->receptor}}/{{$_SESSION['usuario']->RFC}}/{{$factura->PDFsello}}.pdf')"  href="#pdf" ><img class="grow" src="/icons/pdf.png" width="40px" alt=""></a> @endif
            </td>

            <td><a class="btn btn-sm btn-dark"  href="{{route('factura-show', [app()->getLocale(), $factura->ID])}}"><b style="color:white">{{__('Ver más')}}</b></a></td>


        </tr>
            @endforeach


        </tbody>

    </table>
</div>

</div>
<!-- Modal Orden de Compra -->
<div class="modal" id="modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{__('Añadir orden de compra')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <!-- Aquí va el formulario para el registro -->
          <!-- Asegúrate de tener un campo oculto para almacenar el ID del registro -->
          <form action="{{route('add-order', app()->getLocale())}}" method="POST">
            @csrf
            <!-- Campos del formulario -->
            <!-- Puedes usar los campos necesarios para el registro -->
            <div class="form-group">
                <label for="OrdenCompra">{{__('Orden de Compra')}}</label>
                <input type="text" name="OrdenCompra" class="form-control" id="OrdenCompra"  placeholder="{{__('Ingrese la Orden de Compra')}}">
              </div>

            <!-- Campo oculto para almacenar el ID del registro -->
            <input type="hidden" id="registroid" name="registroid" value="">
            <!-- Otros campos del formulario -->

        </div>
        <div class="modal-footer">
            <!-- Botón de envío del formulario -->
            <button type="submit" class="btn btn-primary">Registrar</button>
          </form>

        </div>
      </div>
    </div>
  </div>
    <!-- Modal para mostrar el archivo PDF-->
    <div class="modal" id="fileModal" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-xl " role="document">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title">Vista previa del archivo PDF</h5>
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

            </div>
        </div>
    </div>

        <!-- Modal para mostrar el archivo XML -->
        <div class="modal" id="xmlModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title">Vista previa del archivo XML</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                    <div class="modal-body">
                        <div id="pdfContainer">
                            <!-- Aquí se mostrará el contenido del PDF -->
                        </div>

                    </div>

                </div>
            </div>
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
<!-- JavaScript para controlar el modal -->
<script>
// JavaScript con Bootstrap
document.addEventListener('DOMContentLoaded', () => {
  const modal = new bootstrap.Modal(document.getElementById('modal'));
  const botonesRegistro = document.querySelectorAll('.btn-registro');

  botonesRegistro.forEach((boton) => {
    boton.addEventListener('click', () => {
      const idRegistro = boton.dataset.id;
      document.getElementById('registroid').value = idRegistro; // Rellenar el campo oculto del formulario

      modal.show(); // Mostrar el modal utilizando Bootstrap
    });
  });
});
</script>
<script>
    // Función para cargar y visualizar el PDF seleccionado en el contenedor
    function cargarPDF(rutaArchivo) {
        var fileName = $(this).data("file");
        var fileRFC = $(this).data("rfc");
        var url = '{{route('docs-view', app()->getLocale())}}?archivo=' + decodeURIComponent(rutaArchivo);

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
                 $("#xmlModal .modal-body").html('<iframe type="text/plain" src="/es/docs-view?emisor={{$_SESSION['usuario']->RFC}}&receptor=' +fileRFC +'&archivo='+ decodedFileURL + '" width="100%" height="500px"></iframe>');
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
    $(document).ready(function() {
        var table = $('#facturas-list').DataTable({
            orderCellsTop:true,
            fixedHeader:true,
            responsive: true,
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "{{__('Mostrando')}} _START_ {{__('a')}} _END_ {{__('de')}} _TOTAL_ {{__('Entradas')}}",
                "infoEmpty": "{{__('Mostrando')}} 0 {{__('a')}} 0 {{__('de')}} 0 {{__('Entradas')}}",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "{{__('Mostrar')}} _MENU_ {{__('entradas')}}",
                "loadingRecords": "{{__('Cargando...')}}",
                "processing": "{{__('Procesando...')}}",
                "search": "{{__('Buscar')}}:",
                "zeroRecords": "{{__('Sin resultados encontrados')}}",
                "paginate": {
                    "first": "{{__('Primer')}}",
                    "last": "{{__('Ultimo')}}",
                    "next": "{{__('Siguiente')}}",
                    "previous": "{{__('Anterior')}}"
                }
            },
        });

        // Supongamos que las columnas a las que deseas aplicar los filtros son la 1 y la 3
        var columnsToFilter = [0, 1, 2, 3, 4 ,5 ,6, 7];

        // Creamos una fila en el head de la tabla y lo clonamos para cada columna
        $('#facturas-list thead tr').clone(true).appendTo('#facturas-list thead');

        $('#facturas-list thead tr:eq(1) th').each(function (i) {
            var title = $(this).text(); // es el nombre de la columna

            // Verificamos si el índice de la columna está en el arreglo columnsToFilter
            if (columnsToFilter.includes(i)) {
                $(this).html('<input type="text" placeholder="{{__('Buscar')}}...' + title + '" />');

                $('input', this).on('keyup change', function () {
                    if (table.column(i).search() !== this.value) {
                        table
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });
            } else {
                $(this).empty(); // Dejamos vacío el contenido en las columnas no filtradas
            }
        });

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
