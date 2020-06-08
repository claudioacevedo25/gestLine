<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class mercadoPagoController extends Controller
{
    public function store(Request $request)
    {
        // Aqui tomamos los datos de la notificacion
    }

    public function pending(Request $request) 
    {
        $cart = session('cart')->fresh();
        
        $cart->update([
            'mp_response' => $request->all()
        ]);

        dd($request);
    }

    public function failure(Request $request) 
    {
        dd($request);
    }
    
    public function success(Request $request) 
    {
        
        \DB::select("CALL sp_actualizarFactura()");
        session()->forget('cart');
        return redirect('/product/list');
    }
}
