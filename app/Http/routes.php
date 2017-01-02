<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/auth/login','AuthController@userAuth');

Route::post('/destroyUsers','UserController@destroyUsers');
Route::post('/validarEmail','UserController@validarEmail');
Route::post('/validarEmailUser/{id}','UserController@validarEmailUser');
Route::resource('/user','UserController');

Route::resource('/administrador', 'AdministradorController');

Route::resource('/docente','DocenteController');

Route::resource('/estudiante','EstudianteController');


Route::resource('/compania','CompaniaController');

Route::post('/destroyrolintegrantes','RolIntegranteController@destroyRolintegrantes');
Route::resource('/rolintegrante','RolIntegranteController');

Route::post('/cargar',function (\Illuminate\Http\Request $request){

    $respuesta = new stdClass();
    $respuesta->solicitud = $request->input('solicitud');
    $respuesta->descripcion = $request->input('descripcion');
    $respuesta->file = $request->input('file');

    return response()->json($respuesta);
});

