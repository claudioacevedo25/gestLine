{{-- @extends('layouts.app')

@section('content')
    <div class="container text-center login-container3">
        <div class="detalle-title" >
            <h1><i class="fa fa-shopping-cart">Carrito de compras</i></h1>
        </div>
        <div class="table-cart">
            @if (count($cart))
                <p>
                    <a href="" class="btn btn-danger">Vaciar Carrito <i class="fa fa-trash"></i></a>
                </p>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th>Quitar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $item)
                              <tr>
                                  <td><img src="{{asset('storage').'/'.$item->image}}" alt=""></td>
                              <td>{{$item->name}}</td>
                              <td>{{number_format($item->price,2)}}</td>
                              <td>
                                  <input 
                                        type="number" name="" id="articulo_{{$item->id}}"
                                        class="input-update-item"
                                        min="1"
                                        max="100"
                                        value="{{$item->quantity}}"
                                   >
                                   <a 
                                        href=""
                                        class="btn btn-warning btn-update"
                                        data-href="{{route('cart-update', $item->id)}}"
                                        data-id="{{$item->id}}"
                                   
                                   >
                                        <i class="fa fa-refresh"></i>
                                   </a>
                              </td>
                                <td>
                                    {{number_format($item->price*$item->cantidad, 2)}}
                                </td>
                                <td>
                                    <a href="" class="btn btn-danger"><i class="fa fa-remove"></i></a>
                                </td>
                              </tr>      
                            @endforeach
                        </tbody>
                    </table><hr>
                    <h3>
                        <span class="badage badage-success">
                            Total: ${{number_format($total,2)}}
                        </span>
                    </h3>
                </div>
                @else
                    <h3><span class="badage badage-warning">No hay productos en el carrito</span></h3>
            @endif
            <hr>
            <p>
                <a href="" class="btn btn-primary"><i class="fa fa-chevron-circle-left">Seguir Comprando</i></a>
                @if (count($cart))
                    <a href="" class="btn btn-primary">Continuar <i class="fa fa-chevron-circle-right"></i></a>                    
                @endif
            </p>
        </div>
    </div>
@endsection --}}


@extends('layouts.app')

@section('content')

    @if ($cart)
    
                
                    <div class="row">
                    <div class="col">
                        <table class="table table-hover shadow p-3 mb-5 bg-light rounded">
                            <thead>
                            <tr>
                                <td>Imagen</td>
                                <td>Producto</td>
                                <td>Cantidad</td>
                                <td></td>
                                <td>Precio Unitario</td>
                                <td>Sub Total</td>  
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($cart->items as $item)
                                <tr>
                                    <td>
                                        <img class="img-thumbnail" src='/storage/imgArticulos/{{$item->img}}' alt='{{$item->nombre}}' width="100px" height="100px">
                                    </td>
                                    <td>{{ $item->observaciones }}</td>
                                    <td>
                                        <form action="{{ url('/carrito', $item->id) }}" method="post">
                                            @csrf
                                            <div class="input-group">
                                                <input 
                                                type="number" 
                                                name="qty" 
                                                class="form-control"
                                                min="1"
                                                max="50"
                                                value="{{$item->qty}}"
                                                >
                                                <input type="hidden" name="x" value="si">
                                                <input type="hidden" name="id" value="{{$item->id}}">
                                                <button class="input-group-btn" type="submit"><i class="fas fa-retweet"></i></button>                                              
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ url('/carrito/deleteItem', $item->id) }}" method="post">
                                            @csrf
                                            <button class="input-group-btn" type="submit"><i class="fas fa-trash-alt fa-2x"></i></button>                                              
                                        </form>                          
                                    </td>
                                    <td>{{ number_format( $item->precio_venta , 2)}}</td>
                                    <td>{{$item->subtotal()}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <hr>

                        <div class="text-right">
                            <div class="col-12">
                                <h3 class="">TOTAL: $ {{$total}}</h3>
                            </div>
                        </div>

                        <hr>


                        <div>
                            <div>
                                {{-- <a href="{{url('/carrito/confirm')}}" class="btn btn-primary">Confirmar</a>   --}}
                                  
                                <form method="post" action="{{ url('/cartOK') }}"> 
                                    {{ csrf_field() }}
                                     <button type="submit" class="btn btn-primary">Confirmar</button> 
                                     <a href="{{ url('/product/list') }}" class="btn btn-outline-primary">Seguir Comprando</a>      
                                </form>
                               <div class="text-right">
                                   <form action="{{ url('/cart/empty') }}" id='emptycart' method="get">
                                        <button type="submit" class="btn btn-outline-danger ">Vaciar Carrito</button>
                                   </form>
                               </div>
                               
                            </div>
                        </div>
                        

          
        </div>
    </div>
    


    @else
        <div class="center-block ">
            <div class="col">
                <h1 class="text-center text-uppercase p-3 mb-2 bg-info text-white  shadow p-3 mb-5 bg-info rounded">Tu carrito esta vacio</h1><hr><br><br><br><br><br><br><br>
                <a href={{url('/product/list')}} class="btn btn-outline-primary btn-lg">Empezar a comprar</a>
            </div>
           
        </div>
        
        
    @endif

@endsection
