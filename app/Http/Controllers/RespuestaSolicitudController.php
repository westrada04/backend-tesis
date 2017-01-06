<?php

namespace App\Http\Controllers;

use App\CorrespondenciaEnviada;
use App\RespuestaSolicitud;
use App\Solicitud;
use Illuminate\Http\Request;

use App\Http\Requests;

class RespuestaSolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $respuestasolicitud = RespuestaSolicitud::with("correspondenciaenviada")->with("solicitud")->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $correspondenciaenviada = CorrespondenciaEnviada::lists("id", "id")->prepend('Please select', '');
        $solicitud = Solicitud::lists("id", "id")->prepend('Please select', '');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        RespuestaSolicitud::create($request->all());
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
        $respuestasolicitud = RespuestaSolicitud::find($id);
        $correspondenciaenviada = CorrespondenciaEnviada::lists("id", "id")->prepend('Please select', '');
        $solicitud = Solicitud::lists("id", "id")->prepend('Please select', '');
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
        $respuestasolicitud = RespuestaSolicitud::findOrFail($id);
        $respuestasolicitud->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RespuestaSolicitud::destroy($id);
    }

    public function massDelete(Request $request)
    {
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            RespuestaSolicitud::destroy($toDelete);
        } else {
            RespuestaSolicitud::whereNotNull('id')->delete();
        }
    }

}
