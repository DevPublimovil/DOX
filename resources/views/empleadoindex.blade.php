@extends('layouts.dox')

@section('content')
    <div class="row">
        <div class="col-12">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-6 col-xs-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h1 class="card-title">Correspondencia pendiente</h1>
                </div>
                <div class="card-body">
                    @if (count($documentos)>0)
                        <ul class="list-group">
                           @foreach ($documentos as $item)
                                <li class="list-group-item">{{$item->tipo->nombre}} - {{$item->descripcion}} <button type="button" onclick="agregar({{$item->id}})" class="btn btn-sm btn-danger pull-right" data-toggle="modal" data-target="#confirmModal">Rechazar</button></li>
                           @endforeach
                        </ul>
                    @else
                        <p class="text-center">¡Al parecer no tienes correspondencia pendiente!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
      
      <!-- Modal -->
      <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <h6 class="text-center">¿Estas seguro que deseas rechazar esta correspondencia?</h6>
              <form method="POST" id="rechazarDocument">
                  @csrf
                  <input type="hidden" name="_method" value="PUT">
                  <div class="form-group">
                      <label for="description">Motivo:</label>
                      <textarea name="description" id="description" cols="30" rows="3" class="form-control" required></textarea>
                  </div>
                  <div class="row">
                      <div class="col text-center">
                        <small class="text-danger text-sm" id="message"></small>
                      </div>
                  </div>
                  <div class="form-group text-center">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-sm btn-primary" onclick="espera()">Aceptar</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
@endsection

@section('scripts')
    <script>
        function agregar(id){
            $("#rechazarDocument").attr("action", "{{route('documentos.index')}}"+"/"+id);
        }

        function espera(){
            if($("#description").val().length > 0){
                $("#message").html('Por favor espere mientras se guarda la información');
            }
        }
    </script>
@endsection