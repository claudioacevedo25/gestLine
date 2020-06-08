<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articulo;
use App\Categoria;
use App\Proveedores;

class articuloController extends Controller
{
    public function listarArticulos(){
        // $productos = Product::paginate(1);//paginate en vez del metod all();
        $articulos = Articulo::paginate(6);
        $vac = compact('articulos');
        return view('a_listaArticulos',$vac);
    }

    public function listarArticulosVta(){
        $articulos = Articulo::paginate(6);
        $categorias = Categoria::all();
        $vac = compact('articulos', 'categorias');
        return view('a_listaArticulosVta',$vac);
    }

    protected function index(){
        $categoria=Categoria::all();
        $proveedores=Proveedores::all();
        $vac=compact('proveedores','categoria');
        return view('a_altaArticulo', $vac);
    }

    public function storeFiltrado($id){
        $articulos = Articulo::where('id_categoria','=', $id)->paginate(6);
        $categorias = Categoria::all();
        $vac = compact('articulos', 'categorias');
        return view('a_listaArticulosVta',$vac);
    }

    public function articuloId($id)
    {
        $articulo = Articulo::findOrFail($id);
        return view('a_articuloVta')->with('articulo',$articulo);
    }

    public function create( Request $req)
    {

        $precio_costo = $req['precio_costo'];
        $rentabilidad = $req['rentabilidad'];
        $precio_venta = $precio_costo+($precio_costo*$rentabilidad/100);
        $stock = $req['stock'];
                $nuevoArticulo = new Articulo();      
                $nuevoArticulo->nombre = $req['name'];
                $nuevoArticulo->precio_costo = $precio_costo;
                if($req['rentabilidad']){
                    $nuevoArticulo->rentabilidad = $rentabilidad;
                }
                
                if($req['precio_venta'])
                {
                    $nuevoArticulo->precio_venta = $req['precio_venta'];
                }else{
                    $nuevoArticulo->precio_venta = $precio_venta;
                }
                
                $nuevoArticulo->stock = $stock ;
                if($req->file('image')){
                    $pathImage=$req->file('image')->store("public\imgArticulos");
                    $filename = basename($pathImage);
                    $nuevoArticulo->img = $filename;
                }

                $nuevoArticulo->observaciones = $req['observaciones'];
                $nuevoArticulo->id_proveedor = $req['proveedor'];
                $nuevoArticulo->id_categoria = $req['categoria'];
    
                $nuevoArticulo->save();
            
                return redirect('/articulos');
    }

        
    public function delete($id){
        $articulo = Articulo::find($id);
        $articulo->estado = 0;
        $articulo->save();
        return redirect('articulos');
    }

    public function edit($id){
        $articulo = Articulo::find($id);
        $categoria=Categoria::all();
        $proveedores=Proveedores::all();
        $vac=compact('articulo','proveedores','categoria');
         return view('a_editArticulo',$vac);
    }

    public function editPost(Request $req)
    {
       
        $precio_costo = $req['precio_costo'];
        $rentabilidad = $req['rentabilidad'];
        $precio_venta = $precio_costo+($precio_costo*$rentabilidad/100);
        if($req['stock']){
            $stock = $req['stock'];
        }else{
            $stock = 0;
        }
        
                $id = $req['id'];
                $nuevoArticulo = Articulo::find($id);      
                $nuevoArticulo->nombre = $req['name'];
                $nuevoArticulo->precio_costo = $precio_costo;
                $nuevoArticulo->rentabilidad = $rentabilidad;
                if($req['precio_venta'])
                {
                    $nuevoArticulo->precio_venta = $req['precio_venta'];
                }else{
                    $nuevoArticulo->precio_venta = $precio_venta;
                }
                $nuevoArticulo->stock =$nuevoArticulo->stock + $stock;
                $nuevoArticulo->estado = $req['estado'];
               
                if($req->file('image')){
                    $pathImage=$req->file('image')->store("public\imgArticulos");
                    $filename = basename($pathImage);
                    $nuevoArticulo->img = $filename;
                }

                $nuevoArticulo->observaciones = $req['observaciones'];
                $nuevoArticulo->id_proveedor = $req['proveedor'];
                $nuevoArticulo->id_categoria = $req['categoria'];
    
                $nuevoArticulo->save();
            
            return redirect('/articulos');
    }
}
