<?php

namespace App\Http\Controllers;

use App\Rolintegrante;
use Illuminate\Http\Request;

use App\Http\Requests;

class RolIntegranteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $integrantes = Rolintegrante::all();
        return response()->json($integrantes);
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
        $this->validate($request,[
            'rol' => 'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'email' => 'required|email',
            'telefono' => 'required|numeric'
        ]);

        $integrante = new Rolintegrante;
        $integrante->rol = $request->input('rol');
        $integrante->nombres = $request->input('nombres');
        $integrante->apellidos = $request->input('apellidos');
        $integrante->email = $request->input('email');
        $integrante->telefono = $request->input('telefono');
        $integrante->save();

        return response()->json($integrante);
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
        $this->validate($request,[
            'rol' => 'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'email' => 'required|email',
            'telefono' => 'required|numeric'
        ]);

        $integrante = Rolintegrante::find($id);
        $integrante->rol = $request->input('rol');
        $integrante->nombres = $request->input('nombres');
        $integrante->apellidos = $request->input('apellidos');
        $integrante->email = $request->input('email');
        $integrante->telefono = $request->input('telefono');
        $integrante->save();

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
        Rolintegrante::destroy($id);
        return response()->json(true);
    }

    public function destroyRolintegrantes(Request $request){
        $this->validate($request,[
            'roles' => 'required|array'
        ]);
        $integrantes = $request->input('roles');

        Rolintegrante::destroy($integrantes);
        return response()->json(true);

    }

}
