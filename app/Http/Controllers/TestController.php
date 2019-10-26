<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Preguntasyrepuestas;

class TestController extends Controller
{
    public function listPreguntas(){
        $pregunta = DB::table("preguntas")->where('categoria',1)->get();
        $detalles = DB::table('preguntas as p')->join('detalle_preguntas as dp','dp.idpregunta','p.id')
        ->select('dp.id','dp.idpregunta','dp.nom_pregunta','dp.puntaje')
        ->where('p.categoria',1)->get();
        return compact('pregunta','detalles');
    }

    public function listAlumno(Request $request){
        $num_documento = $request->num_documento;
        $alumno = DB::table('personas as p')->join('alumnos as al', 'al.id_persona','=','p.id')
        ->join('padres as pa', 'pa.id','=','al.id_padre')
        ->join('personas as pp','pp.id','=','pa.id_persona')
        ->select('p.nombre','p.apelledop','p.apelledom','al.id')
        ->where('pp.numeroide',$num_documento)
        ->where('al.estadotest', '<',1)->get();
        return compact('alumno');
    }

    public function regRespuesta(Request $request){

        $rpta = $request->data;
        $id_alumno  = $request->id_alumno;
        $puntaje  = $request->puntaje;
        
        foreach($rpta as $ep=>$det){
        
            $rpta = new Preguntasyrepuestas();
            $rpta->id_pregunta =$det['id'];
            $rpta->respuesta = $det['data'];
            $rpta->puntaje =$det['puntaje'];
            $rpta->id_alumno = $id_alumno;
            $rpta->save();
        }

        $alumno = DB::table('alumnos')->where('id',$id_alumno)->update(['estadotest'=>$puntaje]);
    }
}
