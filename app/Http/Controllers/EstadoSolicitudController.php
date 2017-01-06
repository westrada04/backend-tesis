<?php

namespace App\Http\Controllers;

use App\EstadoSolicitud;
use Illuminate\Http\Request;

use App\Http\Requests;

class EstadoSolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estadosolicitud = EstadoSolicitud::all();
        return response()->json($estadosolicitud);
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
        EstadoSolicitud::create($request->all());
        return response()->json(["mensaje"=>"creado correctamente"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estadosolicitud = EstadoSolicitud::find($id);
        return response()->json($estadosolicitud);
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
        $estadosolicitud = EstadoSolicitud::findOrFail($id);
        $estadosolicitud->fill($request->all());
        $estadosolicitud->save();

        return response()->json(["mensaje"=>"creado correctamente"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        EstadoSolicitud::destroy($id);
        return response()->json(["mensaje"=>"Eliminado correctamente"]);
    }
}
