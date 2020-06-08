<?php

namespace App\Http\Controllers;

use App\Sucursales;
use App\User;
use Illuminate\Http\Request;

class usuariosController extends Controller
{
    public function listarUsuarios(){
        $usuarios = User::all();
        $vac = compact('usuarios');
        return view('u_listaUsuarios', $vac);
    }

    public function listarEmpleados(){
    
        $empleados = User::where('role', '=', 'EMPLOYEE_ROLE')->paginate(12);
        $vac = compact('empleados');
        return view('u_listaEmpleados', $vac);
    }

    public function edit($id){
        $usuarios = User::find($id);
        $sucursal = Sucursales::all();
        $vac=compact('usuarios', 'sucursal');
         return view('u_editUsuarios',$vac);
    }

    
    public function editPost(Request $req)
    {
       
                $id = $req['id'];
                $updateUsuario = User::find($id);      
                $updateUsuario->nombre = $req['name'];
                $updateUsuario->apellido = $req['lastName'];
                $updateUsuario->dni = $req['dni'];
                $updateUsuario->direccion = $req['address'];
                $updateUsuario->estado = $req['estado'];
               
                if($req->file('image')){
                    $pathImage=$req->file('image')->store("public\imgUsuarios");
                    $filename = basename($pathImage);
                    $updateUsuario->foto = $filename;
                }

                $updateUsuario->fecha_nacimiento = $req['birth'];
                $updateUsuario->role = $req['rol'];
                $updateUsuario->id_sucursal = $req['sucursal'];
    
                $updateUsuario->save();
            
            return redirect('/cuentas');
    }



    public function delete($id)
    {
        $User = User::find($id);
        $User->estado = 0;
        $User->save();
        return redirect('/cuentas');
    }
}
