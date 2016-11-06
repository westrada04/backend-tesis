<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_Factura extends Model
{

	public function factura(){
		return $this->belongsTo('App\Factura');
	}

	protected $table = 'detalles_facturas';
}
