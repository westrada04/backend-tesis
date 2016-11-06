<?php

use App\Administrador;
use App\Docente;
use App\Estudiante;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->nombres = 'Wilmer Omar';
        $user->apellidos = 'Estrada Diaz';
        $user->telefono = '3177635146';
        $user->email = 'westrada04@gmail.com';
        $user->password = bcrypt('123456789');
        $user->save();

        $administrador = new Administrador;
        $administrador->user_id = $user->id;
        $administrador->save();

        factory(User::class,10)->create()->each(function ($user){
           $user->administrador()->save(factory(Administrador::class)->make());
        });

        factory(User::class,10)->create()->each(function ($user){
           $user->docente()->save(factory(Docente::class)->make());
        });

        factory(User::class,30)->create()->each(function ($user){
            $user->estudiante()->save(factory(Estudiante::class)->make());
        });

        $user2 = new User;
        $user2->nombres = 'Omar';
        $user2->apellidos = 'Estrada Quintero';
        $user2->telefono = '3162744557';
        $user2->email = 'docente@gmail.com';
        $user2->password = bcrypt('123456789');
        $user2->save();

        $docente = new Docente;
        $docente->user_id = $user2->id;
        $docente->save();

        $user3 = new User;
        $user3->nombres = 'Yolima';
        $user3->apellidos = 'Diaz Luna';
        $user3->telefono = '3176255256';
        $user3->email = 'estudiante@gmail.com';
        $user3->password = bcrypt('123456789');
        $user3->save();

        $estudiante = new Estudiante;
        $estudiante->user_id = $user3->id;
        $estudiante->save();

    }
}
