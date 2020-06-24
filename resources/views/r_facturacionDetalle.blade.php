@extends('layouts.admin')

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
@else
<h2>No existe detalle para esta factura</h2>

@endif


    
@endsection