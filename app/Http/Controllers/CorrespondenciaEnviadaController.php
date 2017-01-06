<?php

namespace App\Http\Controllers;

use App\CorrespondenciaEnviada;
use Illuminate\Http\Request;

use App\Http\Requests;

class CorrespondenciaEnviadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $correspondenciaenviada = CorrespondenciaEnviada::with("tipo")->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipo = Tipo::lists("id", "id")->prepend('Please select', '');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        CorrespondenciaEnviada::create($request->all());
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
        $correspondenciaenviada = CorrespondenciaEnviada::find($id);
        $tipo = Tipo::lists("id", "id")->prepend('Please select', '');
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
        $correspondenciaenviada = CorrespondenciaEnviada::findOrFail($id);
        $correspondenciaenviada->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CorrespondenciaEnviada::destroy($id);
    }

    public function massDelete(Request $request)
    {
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            CorrespondenciaEnviada::destroy($toDelete);
        } else {
            CorrespondenciaEnviada::whereNotNull('id')->delete();
        }

    }
}
