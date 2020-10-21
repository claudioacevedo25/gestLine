<?php

namespace App\Http\Controllers;

use App\Sucursales;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


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

    public function contactEmail (Request $req)
    {
    
        $reglas = [
            'name' => ['required', 'string','min:2', 'max:20'],
            'lastname' => ['required', 'string','min:2', 'max:20'],
            'email' => ['required', 'email'],
            'message' => ['required', 'string', 'min:10','max:1000'],
        ];
      
       $this->validate($req,$reglas);

        $nombre = $req['name'];
        $apellido = $req['lastname'];
        $email = $req['email'];
        $telefono = $req['phone'];
        $mensaje = $req['message'];
        $alertMessage = 'Gracias por contactar con GESTLINE. A la brevedad nos pondremos en contacto contigo';
      
        $datos = [
            'titulo' => 'El cliente '.$nombre .', '.$apellido.' quiere ponerse en contacto',
            'contenido'=> "Mensaje: " .$mensaje. ' Mi emial es ' .$email .' y mi telefono es '.$telefono
        ];

        MAIL::send('emails.test', $datos, function($mensaje){
            $mensaje->to('claudioacevedo25@gmail.com', 'Destinatario')->subject('¡Tienes un nuevo mensaje de gestline!');
        });

        return redirect('/contact')->with('success', $alertMessage);
    }
}
