@extends('layouts.app')

@section('content')
<h1>Reportes</h1>
<a href="{{url('/reportes/facturacion')}}">Facturacion</a><br>
<a href="{{url('/reportes/estadisticas')}}">Estadisticas</a>
    
@endsection