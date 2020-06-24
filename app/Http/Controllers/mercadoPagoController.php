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
        session()->forget('cart');
        return redirect('/product/list');
    }
}
