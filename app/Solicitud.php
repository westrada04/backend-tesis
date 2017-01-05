<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Solicitud extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'asunto',
        'descripcion',
        'user_id',
        'estadosolicitud_id',
        'fecha',
        'categoria_id'
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'User_id');
    }

    public function estadosolicitud()
    {
        return $this->hasOne('App\EstadoSolicitud', 'id', 'estadosolicitud_id');
    }

    public function categoria()
    {
        return $this->hasOne('App\Categoria', 'id', 'categoria_id');
    }

}
