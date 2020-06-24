@extends('layouts.admin')

@section('content')

<form action="{{url('/reportes/estadisticas')}}" method="post" id="form1">
@csrf
<input type="hidden" name="id" value="1">
</form>
<div class="row">
    <div class="col-6">
        <h3 class="text-uppercase p-3 mb-2 bg-info text-white">Por Mes</h3>
        <div class="row shadow-lg p-3 mb-5 bg-white rounded">
            <div>
                <canvas id="myChart" width="400" height="400"></canvas>
                <h3 id="avgMensual"></h3>
            </div>
        </div>
    </div>

    <div class="col-6">
        <h3 class="text-uppercase p-3 mb-2 bg-info text-white">Por Año</h3>
        <div class="row shadow-lg p-3 mb-5 bg-white rounded">
            <div>
                <canvas id="myChart2" width="400" height="400"></canvas>
                <h3 id="avgAnual"></h3>
            </div>  
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-6">
        <h3 class="text-uppercase p-3 mb-2 bg-info text-white">Top 5 mas vendidos</h3>
        <div class="row shadow-lg p-3 mb-5 bg-white rounded">
            <div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Cantidad</th>
                        </tr>
                    </thead>
                    <tbody id="top5"></tbody>
                </table>
            </div>  
        </div>
    </div>

    <div class="col-6">
        <h3 class="text-uppercase p-3 mb-2 bg-info text-white">Articulos con Stock < 20</h3>
        <div class="row shadow-lg p-3 mb-5 bg-white rounded">
            <div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Stock</th>
                        </tr>
                    </thead>
                    <tbody id="stock"></tbody>
                </table>
            </div>  
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-6">
        <h3 class="text-uppercase p-3 mb-2 bg-info text-white">Clientes Registrados por mes</h3>
        <div class="row shadow-lg p-3 mb-5 bg-white rounded">
            <div>
                <canvas id="myChart3" width="400" height="400"></canvas>
                <h3 id="clientTotal"></h3>
            </div>  
        </div>
    </div>
    <div class="col-6">
        <h3 class="text-uppercase p-3 mb-2 bg-info text-white">Top Clientes</h3>
        <div class="row shadow-lg p-3 mb-5 bg-white rounded">
            <div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Ventas(cantidad)</th>
                        </tr>
                    </thead>
                    <tbody id="topClientes"></tbody>
                </table>
            </div>  
        </div>
    </div>

</div>




@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script>
        
    var mes = [];
    var importe = [];
    var avgMensual=0;
    var mes1=[];
    var importe1=[];
    var avgAnual = 0;

    var clienteMes=[];
    var cantidad=[];
    var totalClient=0;

    $(document).ready(function(){
        $.ajax({
            url:'/reportes/estadisticas/mes',
            method: 'POST',
            data:$('#form1').serialize()             
        }).done(function(res){
            var facturadoPorMeses = JSON.parse(res);
            var lengthMensual = facturadoPorMeses.length;
            for(var i=0; i<lengthMensual; i++){
                avgMensual +=facturadoPorMeses[i].Total;
                mes.push(facturadoPorMeses[i].Mes);
                importe.push(facturadoPorMeses[i].Total);
            }
            generarGrafica(mes,importe,'myChart');
            avgMensual = 'Promedio Mensual: $'+ (avgMensual/lengthMensual).toFixed(2);
            $('#avgMensual').append(avgMensual);
        
        })
        
        $.ajax({
            url:'/reportes/estadisticas/anx',
            method: 'POST',
            data:$('#form1').serialize()             
        }).done(function(res){
            var facturadoPoranx = JSON.parse(res);
            var lengthAnual = facturadoPoranx.length;
            for(var i=0; i<lengthAnual; i++){
                avgAnual +=facturadoPoranx[i].Importe;
                mes1.push(facturadoPoranx[i].Anx);
                importe1.push(facturadoPoranx[i].Importe);
            }
            generarGrafica(mes1,importe1,'myChart2');
            avgAnual = 'Promedio Anual: $'+(avgAnual/lengthAnual).toFixed(2);
            $('#avgAnual').append(avgAnual);
        })

        $.ajax({
            url:'/reportes/estadisticas/clientes',
            method: 'POST',
            data:$('#form1').serialize()             
        }).done(function(res){
            var registroClientes = JSON.parse(res);
            var lengthRegistros = registroClientes.length;
            for(var i=0; i<lengthRegistros; i++){
                totalClient +=registroClientes[i].Total;
                clienteMes.push(registroClientes[i].Mes);
                cantidad.push(registroClientes[i].Total);
            }
            generarGrafica(clienteMes,cantidad,'myChart3', 'Total');
            totalClient = 'Total de clientes: '+totalClient;
            $('#clientTotal').append(totalClient);
        })


        $.ajax({
            url:'/reportes/estadisticas/topClientes',
            method: 'POST',
            data:$('#form1').serialize()             
        }).done(function(res){
            var topClientes = JSON.parse(res);
            var lengthRegistros = topClientes.length;
            for(var i=0; i<lengthRegistros; i++){
               var table = '<tr class="table-success"><td>'+topClientes[i].Id+'</td>';
                table+='<td>'+topClientes[i].Nombre+'</td>';
                table+='<td>'+topClientes[i].Cantidad_facturas+'</td></tr>';
                $('#topClientes').append(table);
            }       
        })


        $.ajax({
            url:'/reportes/estadisticas/top5',
            method: 'POST',
            data:$('#form1').serialize()             
        }).done(function(res){
            var top5 = JSON.parse(res);
            var lengthRegistros = top5.length;
            for(var i=0; i<lengthRegistros; i++){
               var table = '<tr class="table-success"><td>'+top5[i].id_articulo+'</td>';
                table+='<td>'+top5[i].Nombre+'</td>';
                table+='<td>'+top5[i].Cantidad+'</td></tr>';
                $('#top5').append(table);
            }       
        })


        $.ajax({
            url:'/reportes/estadisticas/stockMin',
            method: 'POST',
            data:$('#form1').serialize()             
        }).done(function(res){            
            var stock = JSON.parse(res);
            var lengthRegistros = stock.length;
            for(var i=0; i<lengthRegistros; i++){
               var table = '<tr class="table-danger"><td>'+stock[i].Id+'</td>';
                table+='<td>'+stock[i].Nombre+'</td>';
                table+='<td>'+stock[i].Stock+'</td></tr>';
                $('#stock').append(table);
            }       
        })
         



        function generarGrafica(labels, data, id,titulo='$')
        {
            var ctx = document.getElementById(id).getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: titulo,
                        data: data,
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