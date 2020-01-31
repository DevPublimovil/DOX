<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body class=" bg-white">
    <div class="row justify-content-center">
        <div class="col-2 text-right mt-4 mb-2">
            <img src="{{asset('images/bg-dox.png')}}" width="40%" alt="DOX">
        </div>
        <div class="col-2 text-left mt-4 mb-2">
            <img src="http://publimovil.iw.sv/images/publimovil-logo-dark.png" alt="publimovil">
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card shadow shadow-lg" style="border:orangered 1px solid">
                <div class="card-body text-center">
                    <p>¡Buen día!<br><strong class="text-danger">DOX</strong> te informa que tienes correspondecia en recepción</p>

                    <div class="info-box m-4 text-left">
                        <h5 class="mt-4 font-weight-bold">Correspondencia: <small>{{$tipo}}</small></h5>
                        <h5 class="mt-4 font-weight-bold">Detalles: <small>{{$detalles}}</small></h5>
                    </div>
                </div>
                <div class="card-footer text-center" style="background-color:orangered;color:papayawhip">
                    Este es mensaje auto-generado desde el sitio web de DOX. Por favor, no respondas a este correo.
                </div>
            </div>
        </div>
    </div>
</body>
</html>