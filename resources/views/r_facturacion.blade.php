@extends('layouts.admin')

@section('content')
<h1 class="text-uppercase">Facturacion</h1><hr>

<div class="row">
    <div class="col">
        <form action="{{url('/reportes/facturacion')}}" method="post" class="form-inline">
            @csrf
            <div class="form-group mb-2">
                <input type="month" id="start" name="fecha" min="2018-01" value="2020-04" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary ml-1 mb-2">Por Mes</button><br>
        </form>
    </div>
    <div class="col">
        <form action="{{url('/reporte/facturacionPorFecha')}}" method="post" class="form-inline">
            @csrf
            <div class="form-group mb-2">
                <input type="date" id="start" name="fecha" min="2018-01" value="2018-01" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary ml-1 mb-2">Por Fecha</button><br>
        </form>
    </div>
    <div class="col">
        <a href="{{url('/reporte/facturacionDiaria')}}" class="btn btn-primary ml-4 mb-2">Facturacion Diaria</a>
        <a href="{{url('/reporte/facturacionAnx')}}" class="btn btn-primary ml-4 mb-2">Facturacion Anual</a>
    </div>
</div><hr>
@if (count($facturacion)>0)

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Fecha</th>
            <th scope="col">Nombre</th>
            <th scope="col">Total</th>
            <th scope="col">Ver</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($facturacion as $item)
    
        <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->fecha}}</td>
                <td>{{$item->Nombre}}</td>
                <td>$ {{$item->Total}}</td>
                <td>
                    <form action="{{url('/reportes/facturacion/verDetalle',$item->id)}}" method="post" class="form-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary"><i class="far fa-eye"></i></button>
                    </form>
                </td>
            
        </tr>
        @endforeach
    </tbody>
</table>
<div>
    <h3 for="" class="font-weight-bold">Total Facturado ${{$total}}</h3>
</div>
@else
<h2>No hay facturas para la fecha seleccionada</h2>

@endif


    
@endsection