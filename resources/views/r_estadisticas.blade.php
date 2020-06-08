@extends('layouts.app')

@section('content')
<h1 class="text-uppercase">Por Mes</h1><hr>
<form action="{{url('/reportes/estadisticas')}}" method="post" id="form1">
@csrf
<input type="hidden" name="id" value="1">
</form>

<div class="row col-6">
    <canvas id="myChart" width="400" height="400"></canvas>
</div>


@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script>
        
    var mes = [];
    var importe = [];

    $(document).ready(function(){
        $.ajax({
            url:'/reportes/estadisticas',
            method: 'POST',
            data:$('#form1').serialize()             
        }).done(function(res){
            var facturadoPorMeses = JSON.parse(res);
            for(var i=0; i<facturadoPorMeses.length; i++){
                mes.push(facturadoPorMeses[i].Mes);
                importe.push(facturadoPorMeses[i].Total);
            }
            generarGrafica();
        })
         
        function generarGrafica()
        {
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: mes,
                    datasets: [{
                        label: 'EN $',
                        data: importe,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }

    })




    </script>
    
@endsection