<?php

namespace App\Http\Controllers;

use App\Administrador;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::has('administrador')->get();
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
            'email' => 'required|email|unique:users'
            // 'password' => 'required'
        ]);

        $user = new User;
        $user->nombres = $request->input('nombres');
        $user->apellidos = $request->input('apellidos');
        $user->telefono = $request->input('telefono');
        $user->email = $request->input('email');
        $user->password = bcrypt('123456789');
        $user->save();

        $administrador = new Administrador;
        $user->administrador()->save($administrador);

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
}
