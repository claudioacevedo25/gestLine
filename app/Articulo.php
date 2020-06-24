<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    public $timestamps = false;
    public $guarded = [];

    public function proveedor(){
        return $this->belongsTo(Proveedores::class,'id_proveedor');
    }

    public function categoria(){
        return $this->belongsTo(Categoria::class,'id_categoria');
    }

    public function preferences()
    {
        return $this->belongsToMany(Preference::class);
    }

    
    public function subTotal (){
        return $this->precio_venta*$this->qty;
    }
    
}
