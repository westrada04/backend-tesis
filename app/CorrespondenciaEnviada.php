<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CorrespondenciaEnviada extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'codigo',
        'asunto',
        'descripcion',
        'tipo_id'
    ];

    public function tipo(){
        return $this->hasOne('App\Tipo', 'id', 'tipo_id');
    }
}
