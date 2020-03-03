<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'DOX') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <style>
            .content-wrapper{
                background-color:#FFFFFF;
            }
            .activo-link{
                background-color: orangered;
                color: #FFFFFF;
            }
        </style>
         <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">
         <link rel="stylesheet" href="{{asset('css/publimovil.css')}}">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('font-awesome/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
        @yield('styles')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">
        <div class="wrapper" id="app">
            @include('layouts.header')
            @include('layouts.menu')

            <div class="content-wrapper" style="padding-top:20px;padding-bottom:20px;">
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid" v-if="empleado != ''">
                        <search-component></search-component>
                    </div>
                    <div class="container-fluid" v-else>
                        @yield('content')
                    </div><!-- /.container-fluid -->
                </section>
            </div>
            <modal-detalle></modal-detalle>
        </div>

       <script src="{{asset('js/app.js')}}"></script>
       <script src="{{asset('js/adminlte.min.js')}}"></script>
       <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
       <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
       @yield('scripts')
    </body>
</html>
