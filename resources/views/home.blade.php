@extends('layouts.dox')

@section('content')
<adddocument-component :empresas="{{$companias}}" :empleados="{{$empleados}}" :tipos="{{$tipos}}"></adddocument-component>
@endsection
