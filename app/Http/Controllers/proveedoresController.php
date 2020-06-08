<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedores;
use App\Rubro;

class proveedoresController extends Controller
{
    public function listarProveedores(){
        // $productos = Product::paginate(1);//paginate en vez del metod all();
        $proveedores = Proveedores::all();
        $vac = compact('proveedores');
        return view('listaProveedores',$vac);
    }

    protected function index(){
        return view('altaProveedores');
    }

    public function create( Request $req){
 
                $nuevoProveedor = new Proveedores();      
                $nuevoProveedor->razon_social = $req['name'];
                $nuevoProveedor->direccion = $req['address'];
                $nuevoProveedor->telefono = $req['tel'];
                $nuevoProveedor->email = $req['email'];
                $nuevoProveedor->id_rubro = $req['rubro'];
    
                $nuevoProveedor->save();
            
            return redirect('/proveedores');
        }

        
    public function delete($id){
        $proveedores = Proveedores::find($id);
        $proveedores->estado = 0;
        $proveedores->save();
        return redirect('/proveedores');
    }

    public function edit($id){
        $proveedores = Proveedores::find($id);
        $rubros=Rubro::all();
        $vac=compact('proveedores','rubros');
         return view('editProveedores',$vac);
    }

    public function editPost(Request $req)
    {
        
        $id = $req['id'];
        $proveedores = Proveedores::find($id);
        $proveedores->razon_social = $req['name'];
        $proveedores->direccion = $req['address'];
        $proveedores->telefono = $req['tel'];
        $proveedores->email = $req['email'];
        $proveedores->estado = $req['estado'];
        $proveedores->id_rubro = $req['rubro'];
          
        $proveedores->save();
    
    return redirect('/proveedores');
    }
}
