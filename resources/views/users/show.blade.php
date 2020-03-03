@extends('layouts.dox')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8 col-sm-8 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detalles del empleado</h3>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <img src="{{asset('storage/'.$user->avatar)}}" class="img-circle img-fluid" alt="avatar">
                        </div>
                    </div>
                    <div class="detalles m-4">
                        <p><strong>Nombre: </strong>{{$user->name}}</p>
                        <p><strong>Correo: </strong>{{$user->email}}</p>
                        <p><strong>Teléfono: </strong>{{$user->telefono}}</p>
                        <p><strong>Puesto: </strong>{{$user->puesto}}</p>
                        <p><strong>Compañia: </strong>{{$user->compania->nombre}}</p>
                        <p><strong>Departamento: </strong>{{$user->departamento->nombre}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection