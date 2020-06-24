<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class estadisticasController extends Controller
{
    public function index()
    {    
        return view('r_estadisticas');
    }

    public function indexGraficaMes(Request $req)
    {
        $facturadoPorMeses = \DB::select('select * from facturadopormes');
        return response(json_encode($facturadoPorMeses),200)->header('Content-type', 'text/plain');
    }
    public function indexGraficaAnx(Request $req)
    {
        $facturadoPoranx = \DB::select('select * from facturadoporanx');
        return response(json_encode($facturadoPoranx),200)->header('Content-type', 'text/plain');
    }

    public function indexGraficaClientes()
    {
        $registroClientes = \DB::select('select * from registroclientesmes');
        return response(json_encode($registroClientes),200)->header('Content-type', 'text/plain');
    }

    public function indexGraficaTop5()
    {
        $top5 = \DB::select('select * from topcinco');
        return response(json_encode($top5),200)->header('Content-type', 'text/plain');
    }
    public function indexGraficaStockMin()
    {
        $stock = \DB::select('select * from stockmenor_veinte');
        return response(json_encode($stock),200)->header('Content-type', 'text/plain');
    }
    public function indexGraficaTopClientes()
    {
        $clientes = \DB::select('select * from top_clientes');
        return response(json_encode($clientes),200)->header('Content-type', 'text/plain');
    }
}
