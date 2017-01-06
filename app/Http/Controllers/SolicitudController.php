<?php

namespace App\Http\Controllers;

use App\Archivo;
use App\Solicitud;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitud=DB::select(
            DB::raw('select id,asunto, descripcion, fecha,  categoria, estado,usuario,rol from(
			
						SELECT solicitud.id, asunto, descripcion, fecha, categoria.nombre as categoria, estado,
						concat (usuario.nombre, " ", usuario.apellido) as usuario, "Estudiante" as rol, solicitud.deleted_at
						FROM solicitud
						join categoria on solicitud.categoria_id=categoria.id
						join estadosolicitud on solicitud.estadosolicitud_id=estadosolicitud.id
						join usuario on solicitud.usuario_id=usuario.id
						join estudiantes on estudiantes.usuario_id=usuario.id
						union 
						SELECT solicitud.id, asunto, descripcion, fecha, categoria.nombre as categoria, estado, 
						concat (usuario.nombre, " ", usuario.apellido) as usuario, "Docente" as rol, solicitud.deleted_at
						FROM solicitud
						join categoria on solicitud.categoria_id=categoria.id
						join estadosolicitud on solicitud.estadosolicitud_id=estadosolicitud.id
						join usuario on solicitud.usuario_id=usuario.id
						join docentes on docentes.usuario_id=usuario.id
				) a	where a.deleted_at IS NULL order by a.id'));

        foreach($solicitud as $soli){

            $sol=Solicitud::join('archivossolicitud','solicitud.id','=','archivossolicitud.solicitud_id')
                ->join('archivo', 'archivossolicitud.archivo_id','=','archivo.id')
                ->select('archivo.id', 'archivo.ruta', 'archivo.descripcion')
                ->where('solicitud.id','=', $soli->id)
                ->get();

            if(!empty($sol)){
                $soli->archivos=$sol;
            }

        }
        return response()->json($solicitud);
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
                $ruta = 'public/solicitudesFiles/'.$solicitud->id.'/'.$fileName;
                $archivo = Archivo::create(['ruta'=>$ruta]);
                $solicitud_id = $solicitud->id;
                $archivo_id = $archivo->id;
                $archivoSolicitud = ArchivosSolicitud::create(['solicitud_id'=>$solicitud_id,'archivo_id'=>$archivo_id]);

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
        $solicitud=DB::select(
            DB::raw('select id,asunto, descripcion, fecha,  categoria, estado,usuario,rol from(
			
						SELECT solicitud.id, asunto, descripcion, fecha, categoria.nombre as categoria, estado,
						concat (usuario.nombre, " ", usuario.apellido) as usuario, "Estudiante" as rol, solicitud.deleted_at
						FROM solicitud
						join categoria on solicitud.categoria_id=categoria.id
						join estadosolicitud on solicitud.estadosolicitud_id=estadosolicitud.id
						join usuario on solicitud.usuario_id=usuario.id
						join estudiantes on estudiantes.usuario_id=usuario.id
						union 
						SELECT solicitud.id, asunto, descripcion, fecha, categoria.nombre as categoria, estado, 
						concat (usuario.nombre, " ", usuario.apellido) as usuario, "Docente" as rol, solicitud.deleted_at
						FROM solicitud
						join categoria on solicitud.categoria_id=categoria.id
						join estadosolicitud on solicitud.estadosolicitud_id=estadosolicitud.id
						join usuario on solicitud.usuario_id=usuario.id
						join docentes on docentes.usuario_id=usuario.id
				)a where  a.deleted_at IS NULL and a.id='.$id));

        if(isset($solicitud[0])){
            foreach($solicitud as $soli){
                $sol=Solicitud::join('archivossolicitud','solicitud.id','=','archivossolicitud.solicitud_id')
                    ->join('archivo', 'archivossolicitud.archivo_id','=','archivo.id')
                    ->select('archivo.id', 'archivo.ruta', 'archivo.descripcion')
                    ->where('solicitud.id','=', $soli->id)
                    ->get();

                if(!empty($sol)){
                    $soli->archivos=$sol;
                }

            }
            return response()->json($solicitud[0]);
        }else{
            return response()->json(array());
        }
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
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->fill($request->all());
        $solicitud->save();
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
        Solicitud::destroy($id);
        return response()->json(["mensaje"=>'Eliminado correctamente']);
    }

    public function solicitudUser(Request $request){
        /*
			SELECT solicitud.id, asunto, descripcion, fecha, categoria.nombre AS categoria, estado, CONCAT( usuario.nombre,  " ", usuario.apellido ) AS usuario, solicitud.deleted_at
			FROM solicitud
			JOIN categoria ON solicitud.categoria_id = categoria.id
			JOIN estadosolicitud ON solicitud.estadosolicitud_id = estadosolicitud.id
			JOIN usuario ON solicitud.usuario_id = usuario.id
			WHERE usuario.id =456
		*/
        $solicitud=Solicitud::join('categoria','solicitud.categoria_id','=','categoria.id' )
            ->join('estadosolicitud','solicitud.estadosolicitud_id', '=', 'estadosolicitud.id')
            ->join('usuario','solicitud.usuario_id','=', 'usuario.id')
            ->where('usuario.id','=', $request->usuario_id)
            ->select('solicitud.id', 'solicitud.asunto', 'descripcion',
                'categoria.nombre AS categoria','estadosolicitud.estado')
            ->get();

        foreach($solicitud as $soli){

            $sol=Solicitud::join('archivossolicitud','solicitud.id','=','archivossolicitud.solicitud_id')
                ->join('archivo', 'archivossolicitud.archivo_id','=','archivo.id')
                ->select('archivo.id', 'archivo.ruta', 'archivo.descripcion')
                ->where('solicitud.id','=', $soli->id)
                ->get();

            if(!empty($sol)){
                $soli->archivos=$sol;
            }

        }
        return response()->json($solicitud);
    }

    public function solicitudStatus(Request $request){

        $solicitud=DB::select(
            DB::raw('select id,asunto, descripcion, fecha,  categoria, estado,usuario,rol from(
			
						SELECT solicitud.id, asunto, descripcion, fecha, categoria.nombre as categoria, estado,estadosolicitud.id as estado_id,
						concat (usuario.nombre, " ", usuario.apellido) as usuario, "Estudiante" as rol, solicitud.deleted_at
						FROM solicitud
						join categoria on solicitud.categoria_id=categoria.id
						join estadosolicitud on solicitud.estadosolicitud_id=estadosolicitud.id
						join usuario on solicitud.usuario_id=usuario.id
						join estudiantes on estudiantes.usuario_id=usuario.id
						union 
						SELECT solicitud.id, asunto, descripcion, fecha, categoria.nombre as categoria, estado, estadosolicitud.id as estado_id,
						concat (usuario.nombre, " ", usuario.apellido) as usuario, "Docente" as rol, solicitud.deleted_at
						FROM solicitud
						join categoria on solicitud.categoria_id=categoria.id
						join estadosolicitud on solicitud.estadosolicitud_id=estadosolicitud.id
						join usuario on solicitud.usuario_id=usuario.id
						join docentes on docentes.usuario_id=usuario.id
				)a where  a.deleted_at IS NULL and a.estado_id='.$request->estado_id).' order by id');

        if(isset($solicitud)){

            foreach($solicitud as $soli){
                $sol=Solicitud::join('archivossolicitud','solicitud.id','=','archivossolicitud.solicitud_id')
                    ->join('archivo', 'archivossolicitud.archivo_id','=','archivo.id')
                    ->select('archivo.id', 'archivo.ruta', 'archivo.descripcion')
                    ->where('solicitud.id','=', $soli->id)
                    ->get();

                if(!empty($sol)){
                    $soli->archivos=$sol;
                }
            }
            return response()->json($solicitud);
        }else{
            return response()->json(array());
        }
    }

}
