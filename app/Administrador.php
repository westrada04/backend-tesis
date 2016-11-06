<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    //
    protected $table = 'administradores';

    public function user(){
        return $this->belongsTo('App\user');
    }
}
