@extends('layouts.admin')

@section('content')

        <!-- ACA VA TODO EL CODIGO -->
        
        <div class="container">
            <div class="row col-12">
              <h1 class="text-uppercase">Listado de Articulos</h1>
              <div class="col-2"></div>
              <div class="col align-self-end">
                <form action="{{route('search')}}" method="get">
                  <div class="form-group">
                      <div class="input-group">
                              <input type="text" class="form-control" name="search"  placeholder="Buscar...">
                              <input type="hidden" name="admin" value="1"> 
                              <span class="input-group-btn">
                                <button type="submit" class="btn btn-outline-primary">Buscar</button>
                             </span>
                      </div>
                  </div>  
              </form>
              </div>
            </div>
          </div>
            <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Imagen</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Observaciones</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Proveedor</th>
                            <th scope="col">Modificar</th>
                            <th scope="col">Baja</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articulos as $key)
                        <tr>
                            <td>
                                <a href="/articulos/edit/{{$key->id}}">
                                                <img class="img-thumbnail" src='/storage/imgArticulos/{{$key->img}}' alt='{{$key->nombre}}' width="100px" height="100px">
                                </a>
                            </td>
                            <td>
                                <p class="text-uppercase">{{$key->nombre}}</p>  
                            </td>
                            <td>
                                <p>$ {{$key->precio_venta}} </p>        
                            </td>
                            <td>
                                <p>{{$key->stock}} </p>
                            </td>
                            <td>
                               @if ($key->estado==1)
                                   <p>Activo</p>
                               @else
                                   <p>Baja</p>
                               @endif
                           </td>
                           <td>    
                              <p>{{$key->observaciones}}</p>
                           </td>
                           <td>    
                             <p>{{$key->categoria->detalle}}</p>
                           </td>
                           <td>    
                             <p>{{$key->proveedor->razon_social}}</p>
                           </td>
                           <td>
                                 <a href="/articulos/edit/{{$key->id}}">
                                    <button class="btn btn-primary">Modificar</button>
                                 </a>
                           </td>
                           <td>    
                                <form  id='formDelete' action="articulos/delete/{{$key->id}}" method="POST" role="form">
                                        {{ csrf_field() }}
                                    <div class="form-group row mb-0">
                                        <div class="">
                                            <input type="hidden" name="id" value={{$key->id}}>
                                            <button type="submit" class="btn btn-danger">
                                                {{ __('Baja') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                           </td>
                        </tr>
                        @endforeach
                    </tbody>
                    
             </table>
                    
             
             <div class="row">
                <div class="col-12 d-flex pt-5 justify-content-center">
                        {{$articulos->links()}}
                </div>
             </div>

            

                <div class="row col-12">
                    <div class="col-2">
                        <a href="/articulos/alta" class="btn btn-primary">Nuevo Articulo</a>
                    </div>
                    <div class="col-4"></div>
                    <div class="col align-self-end">
                        <form id='testForm' action="{{route('updateAll')}}" method="POST" role="form">
                            {{ csrf_field() }} 
                          <div class="form-group">
                              <div class="input-group">
                                      <input type="number" class="form-control" name="ganancia" id="idGanancia" placeholder="% de ganancia...">
                                      <span class="input-group-btn">
                                        <button type="submit" class="btn btn-outline-primary">Aplicar Masivamente</button>
                                     </span> 
                              </div>
                          </div>  
                      </form>
                      </div>
                </div>
            

     
@endsection