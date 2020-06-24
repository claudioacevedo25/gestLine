@extends('layouts.admin')

@section('content')

        <!-- ACA VA TODO EL CODIGO -->
        
        <h1 class="text-uppercase">Listado de Sucursales</h1>
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
            <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Razon Social</th>
                            <th scope="col">Direccion</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Email</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Modificar</th>
                            <th scope="col">Eliminar</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sucursales as $key)
                        <tr>
                            <td>
                                 <a href="/edit/{{$key->id}}">{{$key->id}}</a>
                            </td>
                            <td>
                                <h2 class="nombre">{{$key->razon_social}}</h2>  
                            </td>
                            <td>
                                <p>{{$key->direccion}} </p>        
                            </td>
                            <td>
                                <p>{{$key->telefono}} </p>
                            </td>
                            <td>    
                                 <p>{{$key->email}}</p>
                            </td>
                            <td>
                               @if ($key->estado==1)
                                   <p>Activo</p>
                               @else
                                   <p>Baja</p>
                               @endif
                           </td>
                           <td>
                                 <a href="/sucursales/edit/{{$key->id}}">
                                    <button class="btn btn-primary">Modificar</button>
                                 </a>
                           </td>
                           <td>    
                                <form action="sucursales/delete/{{$key->id}}" method="post">
                                        {{ csrf_field() }}
                                    <div class="form-group row mb-0">
                                        <div class="">
                                            <input type="hidden" name="id" value={{$key->id}}>
                                            <button type="submit" class="btn btn-danger">
                                                {{ __('Eliminar') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                           </td>
                        </tr>
                        @endforeach
                    </tbody>
                    
             </table>
                    {{-- PAGINACION FUTURA --}}
{{-- {{ $proveedores->links() }}       --}}
<a href="/sucursales/alta" class="btn btn-primary">Nueva Sucursal</a>
     
@endsection