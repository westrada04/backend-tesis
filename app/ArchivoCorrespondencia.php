<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArchivoCorrespondencia extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'archivo_id',
        'correspondenciaenviada_id'
    ];

    public function archivo()
    {
        return $this->hasOne('App\Archivo', 'id', 'archivo_id');
    }

    public function correspondenciaenviada()
    {
        return $this->hasOne('App\CorrespondenciaEnviada', 'id', 'correspondenciaenviada_id');
    }
}
