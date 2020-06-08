<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rubro extends Model
{
    public $timestamps = false;
    public $guarded = [];

    public function proveedores(){
        return $this->hasMany(Proveedores::class,'id_rubro');
    }
}
