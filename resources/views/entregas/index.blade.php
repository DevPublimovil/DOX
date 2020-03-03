@extends('layouts.dox')

@section('styles')
    <style>
        table > tbody > tr {
            cursor: pointer;
        }
        table > tbody > tr:hover{
            background-color: #99ccff;
        }
        .identrega{
            display: none;
        }
    </style>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-10 col-12">
       <div class="card shadow shadow-lg">
           <div class="card-header">
                <h6 class="card-title">Listado de entregas</h6>
           </div>
           <div class="card-body">
                <div class="table-responsive mt-4">
                    <table id="entregas_table" class="table table-hover table-bordered text-center table-sm display" style="width:100%">
                        <thead>
                            <tr>
                                <th class="priority-1"></th>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Descripcion</th>
                                <th>Fecha de entrega</th>
                                <th>Firma</th>
                            </tr>
                        </thead>
                    </table>
                </div>
           </div>
       </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready( function () {
            $('#entregas_table').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entregas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total Entregas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entregas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "No se encontro la entrega",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },

                "processing": true,
                "serverSide": true,
                "ajax": '{{ route('entregas.list') }}',
                "columns": [
                    { "data": "id", "visible":true, className: "identrega" },
                    { "data": "user.name", className: "entrega" },
                    { "data": "tipo.nombre", className: "entrega" },
                    { "data": "descripcion", className: "entrega" },
                    { "data": "updated_at", className: "entrega" },
                    { "data": "firma", className: "entrega" }
                ]
            });
            $('#entregas_table tbody').on('click', '.entrega', function () {
                var codigo = $(this).siblings('.identrega').html();
                window.location="{{route('entregas.index')}}"+'/'+codigo;
            } );
        } );
    </script>
@endsection
