<?php

namespace App\Http\Controllers;

use App\Articulo;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class cartController extends Controller
{
   

    public function index()
    {
        if(session()->has('cart'))
        {
            $cart = session('cart')->fresh();
            $total = $this->total();
            // $totalPorArticulo = $this->actualizarCantidad();
            return view('c_cart')->with([
                'cart' => $cart,
                'total' => $total
            ]);
        }
        else
        {
            $cart=[];
            return view('c_cart')->with('cart', $cart);
        }
        
    }

    public function cartEmpty()
    {

        if(session()->has('cart'))
        {
            session()->forget('cart');
        }
        return redirect('/carrito');
    }


    public function deleteItem($id)
    {
    
        if(session()->has('cart')) {
        $item = Articulo::findOrFail($id);
        $cart = session('cart')->fresh();
        $total = $cart->count();
        dd($total);
        if($total == 1){
            session()->forget('cart');
        }else{
             $cart->items()->detach($item);
             session()->put('cart', $cart);
        }
       

        return redirect('/carrito'); 
        }
       
    
    }




    public function confirm(Request $req) 
    {
     
        
        // echo phpinfo();
        $cart = session('cart')->fresh();
        
        \MercadoPago\SDK::setAccessToken(env('MP_TEST_ACCESS_TOKEN'));
        
        $preference = new \MercadoPago\Preference();
        
        $productos = [];
        //ACA vA EL PROCEDIMIENTO ALMACENADO QUE CREA UNA FACTURA NUEVA 
        $id_usuario = auth()->user()->id;
        \DB::select("CALL sp_insertarFactura($id_usuario)");
        
        foreach ($cart->items as $product) {

            $id_articulo = $product->id;
            $cantidad = $product->qty;
            $precio_unitario = $product->precio_venta;
            //ACA VA EL PROCEDIMIENTO ALMACENADO QUE CARGA EL DETALLE DE FACTURA
            \DB::select("CALL sp_agregarDetalleFactura($id_articulo,$cantidad)"); 
           
            $item = new \MercadoPago\Item();     
            $item->title = $product->nombre;
            $item->quantity = $cantidad;
            $item->currency_id = $product->moneda;
            $item->unit_price = $precio_unitario;
            $item->description = $product->observaciones;
            $item->picture_url = $product->img;
            $productos[] = $item;
        }
       
        $preference->items = $productos;

        $preference->back_urls = [
            'success' => url('/mp/success'),
            'failure' => url('/mp/failure'),
            'pending' => url('/mp/pending'),
        ];
        $preference->auto_return = "approved";
        $preference->save();


        
        return redirect($preference->init_point);
    }



    private function total()
    {
        
        $cart = session('cart')->fresh();
        $total = 0;
       
        foreach ($cart->items as $product) {

            $total += $product->subtotal();
        }
        return $total;
    }
}
