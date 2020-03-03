<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Directorio</title>

    <style>
        @page{
            margin: 0%;
            padding: 0%;
        }
        .main{
            margin: 0.5cm;
        }
        table {
            border-collapse: collapse;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            background-color: transparent;
        }
        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        
        .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
        }

        .table tbody + tbody {
        border-top: 2px solid #dee2e6;
        }

        .table-sm th,
        .table-sm td {
        padding: 0.3rem;
        }

        .table-bordered {
        border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
        border: 1px solid #dee2e6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
        border-bottom-width: 2px;
        }

        .table-borderless th,
        .table-borderless td,
        .table-borderless thead th,
        .table-borderless tbody + tbody {
        border: 0;
        }

        .text-center {
            text-align: center !important;
        }
        .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, 0.05);
        }
                .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="main">
        <table style="margin-bottom:5px;width:100%">
            <tr style="margin:0%;padding:0%">
                <td align="center" style="margin:0%;padding:0%"><h1 style="margin:0%;padding:0%">Directorio Telefónico</h1></td>
            </tr>
        </table>
        <table class="table table-sm table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Compañia</th>
                    <th>Departamento</th>
                    <th>Teléfono</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contactos as $key => $contacto)
                    @if($key<=30)
                    <tr>
                        <td>{{$contacto->name}}</td>
                        <td>{{$contacto->compania->nombre}}</td>
                        <td>@if($contacto->departamento != null) {{$contacto->departamento->nombre}} @else &nbsp; @endif</td>
                        <td>{{$contacto->telefono}}</td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    @if(count($contactos) > 30)
        <div class="page-break"></div>
        <div class="main">
            <table class="table table-sm table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Compañia</th>
                        <th>Departamento</th>
                        <th>Teléfono</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contactos as $key => $contacto)
                        @if($key>30 && $key<=62)
                        <tr>
                            <td>{{$contacto->name}}</td>
                            <td>{{$contacto->compania->nombre}}</td>
                            <td>@if($contacto->departamento != null) {{$contacto->departamento->nombre}} @else &nbsp; @endif</td>
                            <td>{{$contacto->telefono}}</td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    @if(count($contactos) > 62)
        <div class="page-break"></div>
        <div class="main">
            <table class="table table-sm table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Compañia</th>
                        <th>Departamento</th>
                        <th>Teléfono</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contactos as $key => $contacto)
                        @if($key>62 && $key<=94)
                        <tr>
                            <td>{{$contacto->name}}</td>
                            <td>{{$contacto->compania->nombre}}</td>
                            <td>@if($contacto->departamento != null) {{$contacto->departamento->nombre}} @else &nbsp; @endif</td>
                            <td>{{$contacto->telefono}}</td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</body>
</html>