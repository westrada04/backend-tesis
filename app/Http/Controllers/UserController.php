<?php

namespace App\Http\Controllers;

use App\Administrador;
use App\Docente;
use App\Estudiante;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function validarEmail(Request $request){
        $user = User::where('email', $request->input('email') )->first();

        if ($user == null){
            return response()->json(true);
        }
        return response()->json(false);
    }

    public function validarEmailUser(Request $request, $id){
        $user = User::where('email', $request->input('email') )->first();
        if ($user == null){
            return response()->json(true);
        }else if ( $user->id == $id){
            return response()->json(true);
        }

        return response()->json(false);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'nombres' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required|numeric',
            'email' => 'required|email|unique:users',
            'rol' => 'required'
            // 'password' => 'required'
        ]);

        $rol = $request->input('rol');

        $user = new User;
        $user->nombres = $request->input('nombres');
        $user->apellidos = $request->input('apellidos');
        $user->telefono = $request->input('telefono');
        $user->email = $request->input('email');
        $user->password = bcrypt('123456789');
        $user->save();

        switch($rol){
            case 'ADMINISTRADOR':
                $administrador = new Administrador;
                $user->administrador()->save($administrador);
                break;
            case 'DOCENTE':
                $docente = new Docente;
                $user->docente()->save($docente);
                break;
            case 'ESTUDIANTE':
                $estudiante = new Estudiante;
                $user->estudiante()->save($estudiante);
                break;
            default:
                $user->delete();
                return response()->json('El rol especificado no existe');
        }

        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombres' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required|numeric',
            'email' => 'required|email',
            'rol' => 'required'
            // 'password' => 'required'
        ]);

        $user = User::find($id);

        $user->nombres = $request->input('nombres');
        $user->apellidos = $request->input('apellidos');
        $user->telefono = $request->input('telefono');
        $user->email = $request->input('email');
        $user->save();
        
        if ($user->rol == $request->input('rol')){
            return response()->json(true);

        }

        switch ($user->rol){
            case 'ADMINISTRADOR':
                $administrador = Administrador::where('user_id',$user->id)->first();
                $administrador->delete();
                break;
            case 'DOCENTE':
                $docente = Docente::where('user_id',$user->id)->first();
                $docente->delete();
                break;
            case 'ESTUDIANTE':
                $estudiante = Estudiante::where('user_id',$user->id)->first();
                $estudiante->delete();
                break;
        }

        switch($request->input('rol')){
            case 'ADMINISTRADOR':
                $administrador = new Administrador;
                $user->administrador()->save($administrador);
                break;
            case 'DOCENTE':
                $docente = new Docente;
                $user->docente()->save($docente);

                return response()->json('valor');
                break;
            case 'ESTUDIANTE':
               $estudiante = new Estudiante;
               $user->estudiante()->save($estudiante);
                break;
        }

        return response()->json(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(true);
    }

    public function destroyUsers(Request $request){
        $this->validate($request,[
            'usuarios' => 'required|array'
        ]);
        $users = $request->input('usuarios');
        User::destroy($users);
        return response()->json(true);
    }

}
