@extends('layouts.admin')

@section('content')
<div class="jumbotron shadow-lg p-3 mb-5 bg-white rounded">
  <h1 class="display-4">Bienvenido a tus Reportes</h1>
  <p class="lead">Aqui podras ver y analizar informacion relacionada a tu negocio, ver la evolucion que ha tendo el mismo durante los años. No dejes de mirar tus Reportes¡¡</p>
  <hr class="my-4">
  <div class="row">
      <div class="col-6">
            <p>Facturacion total por fechas, meses, años...</p>
            <a class="btn btn-primary btn-lg" href="{{url('/reportes/facturacion')}}" role="button">Facturacion</a>
      </div>
      <div class="col-6">
            <p>Estadisticas sobre tus ventas, clientes, etc...</p>
            <a class="btn btn-primary btn-lg" href="{{url('/reportes/estadisticas')}}" role="button">Estadisticas</a>
      </div>
  </div>
 
</div>


    
@endsection