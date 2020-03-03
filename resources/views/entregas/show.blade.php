@extends('layouts.dox')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <h5 class="card-title">Detalles de la entrega</h5>
                </div>
                <img src="{{asset('storage/'.$documento->firma)}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <p class="card-text"><strong>Empleado:</strong> {{$documento->user->name}}</p>
                  <p class="card-text"><strong>Tipo de correspondencia:</strong> {{$documento->tipo->nombre}}</p>
                  <p class="card-text"><strong>Detalles:</strong> {{$documento->descripcion}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection