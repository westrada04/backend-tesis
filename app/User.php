<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['rol'];

    public function administrador(){
        return $this->hasOne('App\Administrador');
    }

    public function docente(){
        return $this->hasOne('App\Docente');
    }

    public function estudiante(){
        return $this->hasOne('App\Estudiante');
    }

    public function getrolAttribute(){

        if ( Administrador::where('user_id',$this->attributes['id'])->first() !== null ){
            return 'ADMINISTRADOR';
        }

        if ( Estudiante::where('user_id', $this->attributes['id'])->first() !== null ){
            return 'ESTUDIANTE';
        }

        if ( Docente::where('user_id', $this->attributes['id'])->first() !== null ){
            return 'DOCENTE';
        }

    }


}
