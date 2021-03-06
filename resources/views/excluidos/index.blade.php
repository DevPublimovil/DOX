@extends('layouts.dox')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-10 col-12">
       <div class="card shadow shadow-lg">
           <div class="card-header">
                <h6 class="card-title">Listado de entregas</h6>
           </div>
           <div class="card-body">
                <div class="table-responsive mt-4">
                    <table id="excluidos_table" class="table table-hover table-bordered text-center table-sm display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Descripcion</th>
                                <th>Fecha recibido</th>
                                <th>Fecha visto</th>
                                <th>Accion</th>
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
        @if (Session::has('status'))
            toastr.success('La correspondencia se eliminó correctamente');
        @endif

        $(document).ready( function () {
            $('#excluidos_table').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Excluidos",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total Excluidos)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Excluidos",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "No se encontro la correspondencia",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },

                "processing": true,
                "serverSide": true,
                "ajax": '{{ route('excluidos.list') }}',
                "columns": [
                    { "data": "user.name" },
                    { "data": "tipo.nombre" },
                    { "data": "descripcion" },
                    { "data": "created_at" },
                    { "data": "updated_at" },
                    { "data": "actions" },
                ]
            });
        } );
    </script>
@endsection