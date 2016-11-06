<?php

use Illuminate\Database\Seeder;

class RolintegrantesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'rol' => 'docente principal',
                'nombres' => 'no especificado',
                'apellidos' => 'no especificado',
                'telefono' => '',
                'email' => ''
            ],
            [
                'rol' => 'docente suplente',
                'nombres' => 'no especificado',
                'apellidos' => 'no especificado',
                'telefono' => '',
                'email' => ''
            ],
            [
                'rol' => 'estudiante principal',
                'nombres' => 'no especificado',
                'apellidos' => 'no especificado',
                'telefono' => '',
                'email' => ''
            ],
            [
                'rol' => 'estudiante suplente',
                'nombres' => 'no especificado',
                'apellidos' => 'no especificado',
                'telefono' => '',
                'email' => ''
            ],
            [
                'rol' => 'egresado principal',
                'nombres' => 'no especificado',
                'apellidos' => 'no especificado',
                'telefono' => '',
                'email' => ''
            ],
            [
                'rol' => 'egresado suplente',
                'nombres' => 'no especificado',
                'apellidos' => 'no especificado',
                'telefono' => '',
                'email' => ''
            ],
            [
                'rol' => 'coordinador de programa',
                'nombres' => 'no especificado',
                'apellidos' => 'no especificado',
                'telefono' => '',
                'email' => ''
            ],
            [
                'rol' => 'director de programa',
                'nombres' => 'Ines del carmen',
                'apellidos' => 'meriño fuentes',
                'telefono' => '',
                'email' => ''
            ]
        ];

        foreach ($roles as $rol){
            $rolintegrante = new \App\Rolintegrante();
            $rolintegrante->rol = $rol['rol'];
            $rolintegrante->nombres = $rol['nombres'];
            $rolintegrante->apellidos = $rol['apellidos'];
            $rolintegrante->telefono = $rol['telefono'];
            $rolintegrante->email = $rol['email'];
            $rolintegrante->save();
        }
    }
}
