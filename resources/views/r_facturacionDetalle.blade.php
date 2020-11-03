{{-- @extends('layouts.admin')

@section('content')
<h1 class="text-uppercase">detalle de factura</h1><hr>


@if (count($detalle)>0)

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Cod Articulo</th>
            <th scope="col">Observaciones</th>
            <th scope="col">Precio Unitario</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($detalle as $item)
    
        <tr>
                <td>{{$item->id_articulo}}</td>
                <td>{{$item->observaciones}}</td>
                <td>{{$item->precio_unitario}}</td>
                <td>{{$item->cantidad}}</td>
                <td>$ {{$item->importe}}</td>
            
        </tr>
        @endforeach
    </tbody>
</table>
<div>
    <label for="" class="font-weight-bold">Total ${{$total}}</label>
</div>
<a href='{{url('/reportes/facturacion/descargarPDF')}}'>Descargar en PDF</a>
@else
<h2>No existe detalle para esta factura</h2>

@endif


    
@endsection --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Factura PDF</title>
</head>
<body>
   <div class="mb-5">
    <div class="row">
        <div class="col">
            <h1 class="text-uppercase">GestLine</h1>
            <small>Llevando tu negocio al maximo</small>
        </div>
        <div class="col">
            <label class="text-uppercase float-right">Factura</label>
        </div>
    </div>
   </div><hr>
    
    <h2 class="text-capitalize">numero de factura: {{$id_fact}}</h2>


@if (count($detalle)>0)

<table class="table table-striped mb-5">
    <thead>
        <tr>
            <th scope="col">Cod Articulo</th>
            <th scope="col">Detalle</th>
            <th scope="col">P/U</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($detalle as $item)
    
        <tr>
                <td>{{$item->id_articulo}}</td>
                <td>{{$item->observaciones}}</td>
                <td>$ {{$item->precio_unitario}}</td>
                <td>{{$item->cantidad}}</td>
                <td>$ {{$item->importe}}</td>
            
        </tr>
        @endforeach
    </tbody>
</table><hr>
<div>
    <label for="" class="font-weight-bold float-right mb-5">Total ${{$total}}</label>
</div>
<div class="container pt-5">
   <label class="font-weight-bold text-uppercase align-text-bottom">Gracias por elegirnos</label>
</div>
@else
<h2>No existe detalle para esta factura</h2>

@endif

</body>
</html>