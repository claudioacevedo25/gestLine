@extends('layouts.app')

@section('content')
    
 
<div class="col-3 container text-center">
    <div>
        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{session()->get('success_message')}}
            </div>    
        @endif
    </div>
 </div>


 
 <div class="container-fluid mt-1 mb-3">
    <div class="row">
        
        <div class="col-1"></div>
        <div class="col-8 row">
            <form action="{{ url('/carrito', $articulo->id) }}" method="post">
                @csrf
                    <div class="card mb-3 shadow p-3 mb-5 bg-white rounded" style="max-width:55rem;">
                        <div class="row no-gutters">
                        <div class="col-md-6">
                            <img  src="{{asset('storage').'/'.'imgArticulos'.'/'.$articulo->img}}" alt=""  width="220px" height="300px" class="rounded">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h3 class="card-title">${{number_format($articulo->precio_venta,2)}}</h3>
                                <p class="card-text">{{$articulo->observaciones}}</p>
                                <div class="card-panel input-group">  
                                    <input type="number" name="qty" id="" min="1"  max= "50" value="1" class="form-control">  
                                    <button class="ml-2 btn btn-outline-primary">Comprar</button>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
            </form>
  
         <div class="col-1"></div>
     </div>
 </div>
 <a href="{{url('/product/list')}}" class="btn btn-outline-primary">Volver</a>

</div>

@endsection