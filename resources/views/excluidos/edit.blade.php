@extends('layouts.dox')

@section('content')
    <form-component :documento="{{$documento}}" :user="{{$user}}"></form-component>
@endsection