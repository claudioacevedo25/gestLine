@extends('layouts.app')

@section('content')
        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img class="d-block img-fluid img-size marcas" src="./images/homeCarrusel11.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block img-fluid" src="./images/homeCarrusel2.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block img-fluid" src="./images/homeCarrusel22.jpg" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="row">

            <div class="col-lg-12 col-md-6 mb-4">
                <h2>¿Quienes somos?</h2>
                <p>GestLine fue diseñado con la necesidad de llevar nuestro negocio de la manera mas eficiente posible. Adecuando todas las necesidades del cliente, brindando calidad y confianza en tus gestiones. Somos tu primera opcion, si buscas el exito en tu negocio.</p>
                <br>

                <br>
                <br>
            </div>

        

        </div>

        <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

        <div class="col-lg-12">


        <div class="mx-auto d-block">
                <div class="row">
                    <div class="col lg-4 ceo">
                        <img class="rounded mx-auto d-block img-thumbnail  " width="120px" src="./images/mia.jpg" alt="imagen acevedo">
                    </div>

                </div>

                <div class="row">
                    <div class="col lg-8 ceo">
                    <span class="text-center">
                        <h2>Claudio Acevedo</h2>
                        
                        <p>CEO </p>
                        </span>
                    </div>

                </div>
        </div>

    
@endsection