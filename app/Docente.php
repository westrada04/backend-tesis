<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    //
    protected $table = 'docentes';

    public function user(){
        return $this->belongsTo('App\user');
    }

}
