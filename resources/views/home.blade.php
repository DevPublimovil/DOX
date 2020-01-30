@extends('layouts.dox')

@section('styles')
    <link rel="stylesheet" href="{{asset('select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('select2/css/select2-bootstrap4.min.css')}}">
@endsection

@section('content')
<adddocument-component :empresas="{{$companias}}" :empleados="{{$empleados}}" :tipos="{{$tipos}}"></adddocument-component>
@endsection