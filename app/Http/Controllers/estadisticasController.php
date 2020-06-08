<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class estadisticasController extends Controller
{
    public function index()
    {    
        return view('r_estadisticas');
    }

    public function indexGrafica(Request $req)
    {
        $facturadoPorMeses = \DB::select('select * from facturadopormes');
        return response(json_encode($facturadoPorMeses),200)->header('Content-type', 'text/plain');
    }
}
