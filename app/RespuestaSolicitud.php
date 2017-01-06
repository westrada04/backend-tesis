<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespuestaSolicitud extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'correspondenciaenviada_id',
        'solicitud_id',
        'respuesta'
    ];

    public function correspondenciaenviada()
    {
        return $this->hasOne('App\CorrespondenciaEnviada', 'id', 'correspondenciaenviada_id');
    }

    public function solicitud()
    {
        return $this->hasOne('App\Solicitud', 'id', 'solicitud_id');
    }
}
