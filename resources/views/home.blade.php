@extends('layouts.dox')

@section('content')
@if ($excluidos > 0)
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <h4><strong>Al parecer tienes documentos excluidos, Por favor verificalos!</strong></h4>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<adddocument-component :empresas="{{$companias}}" :empleados="{{$empleados}}" :tipos="{{$tipos}}"></adddocument-component>
@endsection
