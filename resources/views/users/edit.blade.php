@extends('layouts.dox')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-8 col-xs-12 col-12">
           <form action="{{route('users.update', $user->id)}}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Editar empleado
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="nameuser" value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror" placeholder="Nombre">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Correo</label>
                        <input type="email" name="email" id="email" value="{{$user->email}}" class="form-control @error('email') is-invalid @enderror" placeholder="Correo">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" value="{{$user->telefono}}" class="form-control" placeholder="Teléfono">
                    </div>
                    <div class="form-group">
                        <label for="puesto">Puesto</label>
                        <input type="text" name="puesto" id="puesto" value="{{$user->puesto}}" class="form-control" placeholder="Puesto">
                    </div>
                    <div class="form-group">
                        <label for="compania_id">Compañia</label>
                        <select name="compania_id" id="compania_id" class="form-control">
                            @foreach ($companias as $compania)
                            <option value="{{$compania->id}}" @if($compania->id == $user->compania_id) selected @endif>{{$compania->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="departamento_id">Departamento</label>
                        <select name="departamento_id" id="departamento_id" class="form-control">
                            @foreach ($departamentos as $departamento)
                                <option value="{{$departamento->id}}"  @if($user->departamento_id == $departamento->id) selected @endif>{{$departamento->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="{{route('contactos.index')}}" class="btn btn-sm btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection