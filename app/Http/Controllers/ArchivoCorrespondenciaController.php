<?php

namespace App\Http\Controllers;

use App\Archivo;
use App\ArchivoCorrespondencia;
use App\CorrespondenciaEnviada;
use Illuminate\Http\Request;

use App\Http\Requests;

class ArchivoCorrespondenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $archivocorrespondencia = ArchivoCorrespondencia::with("archivo")->with("correspondenciaenviada")->get();

        return view('admin.archivocorrespondencia.index', compact('archivocorrespondencia'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ArchivoCorrespondencia::create($request->all());
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
        $archivocorrespondencia = ArchivoCorrespondencia::find($id);
        $archivo = Archivo::lists("id", "id")->prepend('Please select', '');
        $correspondenciaenviada = CorrespondenciaEnviada::lists("id", "id")->prepend('Please select', '');
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
        $archivocorrespondencia = ArchivoCorrespondencia::findOrFail($id);
        $archivocorrespondencia->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ArchivoCorrespondencia::destroy($id);
    }

    public function massDelete(Request $request){

        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            ArchivoCorrespondencia::destroy($toDelete);
        } else {
            ArchivoCorrespondencia::whereNotNull('id')->delete();
        }
    }

}
