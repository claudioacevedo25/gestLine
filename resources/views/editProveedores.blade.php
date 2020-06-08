@extends('layouts.app')

@section('content')

         <div class="card">
             <div class="card-header">{{ __('Editar Proveedor') }}</div>
                <div class="card-body">
                        <form action="/proveedores/edit/{{$proveedores->id}}" method="post" >
                                    {{ csrf_field() }}
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value={{$proveedores->razon_social}} required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Direccion') }}</label>

                                    <div class="col-md-6">
                                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value={{$proveedores->direccion}} required autocomplete="address" autofocus>

                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                        <label for="tel" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="tel" type="number" class="form-control @error('tel') is-invalid @enderror" name="tel" value={{$proveedores->telefono}} required autocomplete="tel" autofocus>
            
                                            @error('tel')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>    

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value={{$proveedores->email}} required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>

                                    <div class="col-md-6">
                                        <select name="estado" id="" class="form-control">
                                            <option value=1>Activo</option>
                                            <option value=0>Baja</option>
                                        </select>
                                    </div>
                                </div>    

                                
                                <div class="form-group row">
                                    <label for="rubro" class="col-md-4 col-form-label text-md-right">{{ __('Rubro') }}</label>

                                    <div class="col-md-6">
                                        <select name="rubro" id="" class="form-control">
                                            @foreach ($rubros as $key)            
                                                    <option value={{$key->id}}>{{$key->detalle}}</option>            
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <input type="hidden" name="id" value={{$proveedores->id}}>
                                            <button type="submit" class="btn1 btn">
                                                {{ __('Actualizar Proveedor') }}
                                            </button>
                                        </div>
                                    </div>
                        </form>
                </div>
            </div>
        </div>
    
@endsection