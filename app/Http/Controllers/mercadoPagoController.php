<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class mercadoPagoController extends Controller
{

    public function pending(Request $request) 
    {
        $response = json_encode($request->all());
        $cart = session('cart')->fresh();
        $cart->update([
            'mp_response' => $response
        ]);

        return redirect('/product/list');
    }

    public function failure(Request $request) 
    {
        return redirect('/carrito');
    }
    
    public function success(Request $request) 
    {
        
        \DB::select("CALL sp_actualizarFactura()");
        $factura = \DB::select("select * from ultimafactura");

        foreach($factura as $item)
        {
            $id_factura = $item->ID;
            $nombreCliente = $item->Nombre;
        }
        $this->emailNotification($id_factura, $nombreCliente);
        session()->forget('cart');
        return redirect('/product/list');
    }

    public function emailNotification($id_factura, $nombreCliente)
    {
        $datos = [
            'titulo' => 'El cliente '.$nombreCliente .' ha realizado una nueva compra.',
            'contenido'=> "Revisa la facturacion diaria correspondiente a la factura numero " .$id_factura 
        ];

        MAIL::send('emails.test', $datos, function($mensaje){
            $mensaje->to('claudioacevedo25@gmail.com', 'Destinatario')->subject('¡Tienes una nueva Venta!');
        });
    }
}


