@extends('layouts.admin')


@section('content')
<div class="d-flex justify-content-center">

    
    <div class="col-lg-9 col-md-6 mb-4">
        <div class="row col-12">
            <h2 class="my-4">Alta Sucursal</h2>
            <div class="col-7"></div>
            <div class="align-content-end">
                <a href="{{url('/proveedores')}}" class="btn btn-outline-primary">Volver</a>
            </div>
        </div>

            <div class="card">
                <div class="card-header">{{ __('Alta Sucursal') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('sucursales.create') }}"> 
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
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Direccion') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

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
                                    <input id="tel" type="number" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel') }}" required autocomplete="tel" autofocus>
    
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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Agregar Sucursal') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        
    </div>
</div>
@endsection 