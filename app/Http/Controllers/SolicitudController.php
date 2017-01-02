<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $solicitud = Solicitud::create($request->all());
        $path = public_path().'/solicitudesFiles/'.$solicitud->id.'/';
        $files = $request->file('archivos');

        if(isset($files)){
            foreach($files as $file){
                $fileName = $file->getClientOriginalName();
                $ruta='public/solicitudesFiles/'.$solicitud->id.'/'.$fileName;
                $archivo=Archivo::create(['ruta'=>$ruta]);
                $solicitud_id=$solicitud->id;
                $archivo_id=$archivo->id;
                $archivoSolicitud= ArchivosSolicitud::create(['solicitud_id'=>$solicitud_id,
                    'archivo_id'=>$archivo_id]);

                $file->move($path, $fileName);
            }
        }

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
