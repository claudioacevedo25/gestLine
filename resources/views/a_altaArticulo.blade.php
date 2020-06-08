@extends('layouts.app')


@section('content')
<div class="container">

    <!-- Proveedores-->
    <div class="col-lg-9 col-md-6 mb-4 faqs">
        <h2 class="my-4">Alta Articulo</h2>

            <div class="card">
                <div class="card-header">{{ __('Alta Articulo') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('articulo.create') }}" enctype="multipart/form-data"> 
                        {{-- <form method="POST"  enctype="multipart/form-data"> --}}
                        {{ csrf_field() }}
 
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="precio_costo" class="col-md-4 col-form-label text-md-right">{{ __('Precio de costo $') }}</label>

                            <div class="col-md-6">
                                <input id="precio_costo" type="number" class="form-control @error('precio_costo') is-invalid @enderror" name="precio_costo" value="{{ old('precio_costo') }}" required autocomplete="precio_costo" autofocus>

                                @error('precio_costo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rentabilidad" class="col-md-4 col-form-label text-md-right">{{ __('Rentabilidad %') }}</label>
                            <div class="col-md-6">
                                <input id="rentabilidad" type="number" class="form-control @error('rentabilidad') is-invalid @enderror" name="rentabilidad" value="{{ old('rentabilidad') }}"  autocomplete="rentabilidad" autofocus>

                                @error('rentabilidad')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 

                        <div class="form-group row">
                            <label for="precio_venta" class="col-md-4 col-form-label text-md-right">{{ __('ó Precio de venta $') }}</label>

                            <div class="col-md-6">
                                <input id="precio_venta" type="number" class="form-control @error('precio_venta') is-invalid @enderror" name="precio_venta" value="{{ old('precio_venta') }}"  autocomplete="precio_venta" autofocus>

                                @error('precio_venta')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="stock" class="col-md-4 col-form-label text-md-right">{{ __('stock') }}</label>
    
                                <div class="col-md-6">
                                    <input id="tel" type="number" step="0.01" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock') }}" required autocomplete="stock" autofocus>
    
                                    @error('stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>    

                        <div class="form-group row">
                            <label for="observaciones" class="col-md-4 col-form-label text-md-right">{{ __('Observaciones') }}</label>

                            <div class="col-md-6">
                                <textarea   cols="30" rows="6" id="observaciones" type="text" class="form-control @error('observaciones') is-invalid @enderror" name="observaciones" value="{{ old('observaciones') }}" required autocomplete="observaciones" autofocus></textarea>
 
                                @error('observaciones')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="categoria" class="col-md-4 col-form-label text-md-right">{{ __('Categoria') }}</label>

                            <div class="col-md-6">
                                <select name="categoria" id="" class="form-control">
                                    @foreach ($categoria as $key)            
                                            <option value={{$key->id}}>{{$key->detalle}}</option>            
                                    @endforeach
                                 </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="proveedor" class="col-md-4 col-form-label text-md-right">{{ __('Proveedor') }}</label>

                            <div class="col-md-6">
                                <select name="proveedor" id="" class="form-control">
                                    @foreach ($proveedores as $key)            
                                            <option value={{$key->id}}>{{$key->razon_social}}</option>            
                                    @endforeach
                                 </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Imagen') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class=" @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}"  autocomplete="image" autofocus>

                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn1 btn">
                                    {{ __('Agregar Articulo') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        
    </div>
</div>
@endsection 