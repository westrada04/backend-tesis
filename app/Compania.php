<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compania extends Model
{

	public function facturas(){
		$this->hasMany('App\Factura');
	}

}
