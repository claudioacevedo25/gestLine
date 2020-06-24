@extends('layouts.admin')

@section('content')

        <!-- ACA VA TODO EL CODIGO -->
        
        <h1 class="text-uppercase">Listado de Empleados</h1>
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
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Sucursal</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($empleados as $key)
                        <tr>
                            <td>
                                 <a href="/edit/{{$key->id}}">{{$key->id}}</a>
                            </td>
                            <td>
                                <p class="text-uppercase">{{$key->nombre}}</p>  
                            </td>
                            <td>
                                <p class="text-uppercase">{{$key->apellido}}</p>  
                            </td>
                            <td>
                                <p class=>{{$key->sucursal->razon_social}}</p>  
                            </td>
                            <td>
                                @if ($key->role ==='EMPLOYEE_ROLE')
                                    <p>EMPLEADO</p>
                                @else
                                    <p>No registado</p>
                                @endif  
                            </td>
                            <td>
                               @if ($key->estado==1)
                                   <p>Activo</p>
                               @else
                                   <p>Baja</p>
                               @endif
                           </td>
                           <td>
                                 <a href="/cuentas/edit/{{$key->id}}">
                                    <button class="btn btn-primary">Modificar</button>
                                 </a>
                           </td>
                           <td>    
                                <form action="cuentas/delete/{{$key->id}}" method="post">
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

     
@endsection