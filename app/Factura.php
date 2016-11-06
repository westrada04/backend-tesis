<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
	public function detalle_factura(){
		return $this->hasOne('App\Detalle_Factura');
	}

	public function compania(){
        return $this->belongsTo('App\Compania');
    }
}
