<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoSolicitud extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['estado'];
}
