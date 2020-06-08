@extends('layouts.app')

@section('content')

         <div class="card">
             <div class="card-header">{{ __('Editar Usuario') }}</div>
                <div class="card-body">
                        <form action="/cuentas/edit/{{$usuarios->id}}" method="post" enctype="multipart/form-data" >
                                    {{ csrf_field() }}
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value={{$usuarios->nombre}} required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="lastName" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>

                                    <div class="col-md-6">
                                        <input id="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName" value={{$usuarios->apellido}} >

                                        @error('lastName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="dni" class="col-md-4 col-form-label text-md-right">{{ __('DNI/LC') }}</label>

                                    <div class="col-md-6">
                                        <input id="dni" type="number" class="form-control @error('dni') is-invalid @enderror" name="dni" value={{$usuarios->dni}}  autocomplete="dni" autofocus>

                                        @error('dni')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Direccion') }}</label>

                                    <div class="col-md-6">
                                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value={{$usuarios->direccion}}   >

                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Foto') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="image" type="file" class=" @error('image') is-invalid @enderror" name="image" value={{$usuarios->foto}}  autocomplete="image" autofocus>
        
                                        @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="birth" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Nacimiento') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="birth" type="date" class=" @error('birth') is-invalid @enderror" name="birth" value={{$usuarios->fecha_nacimiento}}  autocomplete="birth" autofocus>
        
                                        @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="rol" class="col-md-4 col-form-label text-md-right">{{ __('Rol') }}</label>

                                    <div class="col-md-6">
                                        <select name="rol" id="" class="form-control">
                                            <option value="ADMIN_ROLE">ADMIN_ROLE</option>
                                            <option value="EMPLOYEE_ROLE">EMPLOYEE_ROLE</option>
                                            <option value="CLIENT_ROLE" selected>CLIENT_ROLE</option>
                                        </select>
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
                                    <label for="sucursal" class="col-md-4 col-form-label text-md-right">{{ __('Sucursal') }}</label>
        
                                    <div class="col-md-6">
                                        <select name="sucursal" id="" class="form-control">
                                            @foreach ($sucursal as $key)            
                                                    <option value={{$key->id}}>{{$key->razon_social}}</option>            
                                            @endforeach
                                         </select>
                                    </div>
                                </div>

                                

                                
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <input type="hidden" name="id" value={{$usuarios->id}}>
                                            <button type="submit" class="btn1 btn">
                                                {{ __('Actualizar Usuario') }}
                                            </button>
                                        </div>
                                    </div>
                        </form>
                </div>
            </div>
        </div>
    
@endsection