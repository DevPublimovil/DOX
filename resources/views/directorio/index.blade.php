@extends('layouts.dox')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                @if (session('info'))
                    <div class="alert alert-success">
                        {{ session('info') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="card card-solid">
            <div class="card-header bg-white">
                <div class="row">
                    <div class="col-6">
                        <h3 class="card-title">
                            Lista de contactos
                        </h3>
                    </div>
                    <div class="col-6 text-right">
                       @if (Auth::user()->hasPermission('send_contactos'))
                       <a href="{{route('contactos.create')}}" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#envioContactos">Enviar contactos</a>
                       @endif
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-1">
                <table id="contactos_table" class="table table-hover text-center table-sm display " style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Compañia</th>
                            {{-- <th>Departamento</th> --}}
                            <th>Cargo</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            @if (Auth::user()->hasPermission('send_contactos'))
                            <th>Opción</th>
                            @endif
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <modal-component :empleados="{{$contactos}}"></modal-component>
    </section>
@endsection

@section('scripts')
    <script>
         $(document).ready( function () {

            @if($errors->any())
                $("#createUser").modal("show");
            @endif

            $('#contactos_table').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Contactos",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total Contactos)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Contactos",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "No se encontro el contacto",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },

                "processing": true,
                "serverSide": true,
                "ajax": '{{ route('contactos.list') }}',
                "columns": [
                   { data: 'name' },
                   { data: 'compania.nombre', name: 'compania.nombre'},
                  /*  { data: 'departamento.nombre', name: 'departamento.nombre'}, */
                   { data: 'cargo' },
                   { data: 'telefono'},
                   { data: 'email'},
                   @if (Auth::user()->hasPermission('send_contactos'))
                   { data: 'opcion' }
                   @endif
                ]
            });
        } );
    </script>
@endsection