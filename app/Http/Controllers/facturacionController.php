<?php

namespace App\Http\Controllers;

use App\Sucursales;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Decimal;

class facturacionController extends Controller
{
    public function index (){
        $facturacion = [];
        return view('r_facturacion')->with('facturacion',$facturacion);
    }

   public function facturacionFiltrado(Request $req)
   {
        $fecha = $req['fecha'];
        $total = 0;
        $anx = substr($fecha,0,4);
        $mes = substr($fecha,5,2);
        $facturacion = \DB::select("CALL  consultaBill ($mes,$anx)");    
        foreach($facturacion as $item){
            $total += $item->Total;
            
        }
        return view('r_facturacion')->with([ 
            'facturacion'=>$facturacion,
            'total'=>number_Format($total, $Decimal=2)
        ]);

   }

   public function facturacionDiaria()
   {
    $total = 0;
    $facturacion = \DB::select("CALL  consultaBill_NOW()");    
    foreach($facturacion as $item){
        $total += $item->Total;
    }
    return view('r_facturacion')->with([
        'facturacion'=>$facturacion,
        'total'=>$total
    ]);

   }

   public function facturacionAnx()
   {
    $total = 0;
    $facturacion = \DB::select("CALL  consultaBill_PorANX()");    
    foreach($facturacion as $item){
        $total += $item->Total;
    }
    return view('r_facturacion')->with([
        'facturacion'=>$facturacion,
        'total'=>$total
    ]);

   }

   public function facturacionPorFecha(Request $req)
   {
       if($req['fecha']){
            $fecha = $req['fecha'];
            $total = 0;
            $facturacion = \DB::select("CALL  consultaBill_PorFecha('$fecha')");    
            foreach($facturacion as $item){
                $total += $item->Total;
            }
       }else{
            $facturacion = [];
            $total = 0 ;
       }
       return view('r_facturacion')->with([
        'facturacion'=>$facturacion,
        'total'=>$total
    ]);

   }


   public function detalleFactura($id)
   {

        $id_fact=$id;  
        $total = 0;
        $detalle = \DB::select("CALL  detalleFactura($id)");    
        foreach($detalle as $item){
            $total += $item->importe;
        }

        $vac = compact('total', 'detalle', 'id_fact');
        $pdf= PDF::loadView('r_facturacionDetalle', $vac);
        return $pdf->stream('factura.pdf');
   }


}
