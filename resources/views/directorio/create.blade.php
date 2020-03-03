@extends('layouts.dox')

@section('content')
    <section class="content">
        <div class="card card-solid" >
            <div class="card-header">
                <h3 class="card-title">Envío de contactos</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            A simple danger alert—check it out!
                          </div>
                    </div>
                </div>
                <contactos-component></contactos-component>
            </div>
        </div>
    </section>
@endsection

