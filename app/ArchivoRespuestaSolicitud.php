<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchivoRespuestaSolicitud extends Model
{
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'respuestasolicitud_id',
        'archivo_id'
    ];

    public static function boot(){
        parent::boot();
        ArchivoRespuestaSolicitud::observe(new UserActionsObserver);
    }

    public function respuestasolicitud()
    {
        return $this->hasOne('App\RespuestaSolicitud', 'id', 'respuestasolicitud_id');
    }

    public function archivo()
    {
        return $this->hasOne('App\Archivo', 'id', 'archivo_id');
    }

}
