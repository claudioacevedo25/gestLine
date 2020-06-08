<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rubro;

class rubroController extends Controller
{
    public function listarRubro(){
        $rubro = Rubro::all();
        $vac = compact('rubro');
        return view('altaProveedores',$vac);
    }
}
