@extends('layouts.cart')

@section('content')

        <!-- ACA VA TODO EL CODIGO -->
        
       {{-- BUSCADOR A REPARAR --}}
             {{-- <form action="{{route('search')}}" method="get">
                <div class="form-group">
                    <div class="input-group">
                            <input type="text" class="form-control" name="search" id="" placeholder="Buscar..."> 
                            <span class="input-group-btn">
                                   <button type="submit" class="btn boton">Buscar</button>
                            </span>
                    </div>
                </div>  
             </form> --}}



            

             <div class="container-fluid mt-1 mb-3">
                 <div class="row">
                     
                     <div class="col-2 filtros p-5 text-center rounded">
                         <h3>Categorias</h3><hr>
                         @foreach ($categorias as $key)
                                <a href='/store/{{$key->id}}'><h5 class="text-uppercase">{{$key->detalle}}</h5></a>    
                         @endforeach
                                <a href='/product/list'><h5 class="text-uppercase">Todos</h5></a>
                     </div>

                     <div class="col-1"></div>
                     <div class="col-8 row">
                         @foreach ($articulos as $key)
                         <form action="{{ url('/carrito', $key->id) }}" method="post">
                            @csrf
                         <div class="card shadow p-3 mb-5 bg-white rounded" style="width: 18rem;">
                            <a href="{{ url('/articulo', $key->id) }}"><img  src="{{asset('storage').'/'.'imgArticulos'.'/'.$key->img}}" alt=""  width="200px" height="200px" class="rounded"><hr></a>
                            <div class="card-body">
                                <h3 class="card-title">${{number_format($key->precio,2)}}</h3>
                                <p class="card-text">{{$key->observaciones}}</p>
                                <div class="card-panel">  
                                    <input type="number" name="qty" id="" min="1"  max= "50" value="1" class="form-control">  
                                    <button class="btn btn-outline-primary">Comprar</button>
                                </div>
                            </div>
                          </div>
                        </form>
                             
                         @endforeach
                        
                     <div class="col-1"></div>
                 </div>
             </div>

             <div class="row">
                <div class="col-12 d-flex pt-5 justify-content-center">
                        {{$articulos->links()}}
                </div>
             </div>
        </div>

        {{-- TOAST BOOSTRAP --}}
        <div aria-live="polite" aria-atomic="true" >
            @if (session()->has('success_message'))
            <div class="toast" style="position: absolute; top: 0; right: 0;" data-animation="true" data-delay="5000">
              <div class="toast-header">
                <i class="far fa-check-circle"></i>
                {{-- <img src="..." class="rounded mr-2" alt="..."> --}}
                <strong class="mr-auto"> Mensaje</strong>
                <small>Nuevo</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="toast-body">
                {{session()->get('success_message')}}
              </div>
            </div>
             @endif
          </div>

        
@endsection