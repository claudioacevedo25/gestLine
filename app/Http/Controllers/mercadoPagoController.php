<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $this->sendWhatsapp();
        session()->forget('cart');
        return redirect('/product/list');
    }

    public function sendWhatsapp()
    {
        $url = "https://wa.me/543513390267text=Tienes%20una%20nueva%20venta!";
        $ch = curl_init($url);
        curl_exec($ch);
        curl_close($ch);
    }
}


