<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sucursales;

class sucursalesController extends Controller
{
    public function listarSucursales(){
        // $productos = Product::paginate(1);//paginate en vez del metod all();
        $sucursales = Sucursales::all();
        $vac = compact('sucursales');
        return view('s_listaSucursales',$vac);
    }

    protected function index(){
        return view('s_altaSucursal');
    }

    public function create( Request $req){
 
                $nuevaSucursal = new Sucursales();      
                $nuevaSucursal->razon_social = $req['name'];
                $nuevaSucursal->direccion = $req['address'];
                $nuevaSucursal->telefono = $req['tel'];
                $nuevaSucursal->email = $req['email'];
    
                $nuevaSucursal->save();
            
            return redirect('/sucursales');
        }

        
    public function delete($id){
        $sucursales = Sucursales::find($id);
        $sucursales->estado = 0;
        $sucursales->save();
        return redirect('/sucursales');
    }

    public function edit($id){
        $sucursales = Sucursales::find($id);
        $vac=compact('sucursales');
         return view('s_editSucursales',$vac);
    }

    public function editPost(Request $req)
    {
        
        $id = $req['id'];
        $sucursales =Sucursales::find($id);
        $sucursales->razon_social = $req['name'];
        $sucursales->direccion = $req['address'];
        $sucursales->telefono = $req['tel'];
        $sucursales->email = $req['email'];
        $sucursales->estado = $req['estado'];
          
        $sucursales->save();
    
    return redirect('/sucursales');
    }
}


