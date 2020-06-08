@extends('layouts.app') 

@section('content')

<!-- ACA VA TODO EL CODIGO DE CONTACTO -->

<form class="form-horizontal" method="post">
    <div class="container">
        
        <div class="col-lg-9 col-md-6 mb-4 faqs">
            <h2 class="my-4">Contactanos</h2>
            <fieldset class="contactenos">

                <div class="form-group">
                    <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                    <div>
                        <input id="fname" name="name" type="text" placeholder="Nombre" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                    <div >
                        <input id="lname" name="name" type="text" placeholder="Apellido" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-envelope-o bigicon"></i></span>
                    <div>
                        <input id="email" name="email" type="text" placeholder="Email" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-phone-square bigicon"></i></span>
                    <div >
                        <input id="phone" name="phone" type="text" placeholder="Teléfono" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
                    <div>
                        <textarea class="form-control" id="message" name="message" placeholder="Coloque su mensaje aquí" rows="7"></textarea>
                    </div>
                </div>

                <div class=" col-sm-offset-3 form-group">
                    <button type="submit" class="btn  btn-lg btn-block login-button boton">Enviar Consulta</button>
                </div>
                <br>
                <br>
                <br>

            </fieldset>
            <div class="form-group">
                <h3>Correo electrónico de soporte:</h3>
                <p>claudioacevedo25@gmail.com</p>
                <h3>Teléfono:</h3>
                <p> 0351-153390267</p>
            </div>
        </div>
        <!-- FIN DEL TEMPLATE -->
    </div>
</form>

@endsection