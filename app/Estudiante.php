<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    //
    protected $table = 'estudiantes';

    public function user(){
        return $this->belongsTo('App\user');
    }

}
