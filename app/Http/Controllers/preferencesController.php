<?php

namespace App\Http\Controllers;

use App\Articulo;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class preferencesController extends Controller
{
   

    public function stored($id, Request $req)
    {
        $this->sendWhatsapp();
        $qty = $req['qty'];
        $item = Articulo::findOrFail($id);
      

        if(!session()->has('cart'))
        {
            
            $cart =  Cart::create();    
            $item->qty = $qty;
            $item->save();
            $cart->items()->attach($item);
            session()->put('cart', $cart);
           
        }else{
            
                $cart = session('cart')->fresh();
            

                foreach($cart->items as $p){   
                    $bandera = 0; 
                    if($p->id == $id){
                        $bandera  = $p->id;
                         break; 
                    }
                }
            
            
                if($bandera != 0){
                    
                    foreach($cart->items as $p){
                    
                        if($p->id == $bandera){
                        
                                if($req['x'] != 'si'){
                                    
                                    $p->qty += $qty;
                                    $p->save();                          
                                }else{
                                
                                    $p->qty = $qty;
                                    $p->save();
                                } 
                            break;
                        }
                        
                    } 
                

                }else{
                    
                        $item->qty = $qty;
                        $item->save();
                        $cart->items()->attach($item);
                        session()->put('cart', $cart);
                    }                       
                
            } 
    
       if($req['x'] === 'si'){
           return redirect('/carrito');
       }
       else{
           return redirect('/product/list')->with('success_message', 'El articulo ha sido agregado a su carrito');
       }
    }


    public function sendWhatsapp()
    {
        $url = "https://wa.me/543513390267?text=Me%20interesa%20el%20auto%20que%20estás%20vendiendo";
        $ch = curl_init($url);
        curl_exec($ch);
        curl_close($ch);
    }
   
}
