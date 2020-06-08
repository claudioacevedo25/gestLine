<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    public $table = "proveedores";
    public $timestamps = false;
    public $guarded = [];

    public function rubro(){
        return $this->belongsTo(Rubro::class,'id_rubro');
    }
}
