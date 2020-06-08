<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{

    public function __construct()
    {
        $this->id_user = auth()->user()->id;
    }
    
    protected $fillable = ['mp_response'];

    public function items()
    {
        return $this->belongsToMany(Articulo::class);
    }


    
}
