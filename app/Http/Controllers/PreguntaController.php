<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Preguntasyrepuestas;


class PreguntaController extends Controller
{
    public function listPreguntaRellenar(Request $request){
        $pregunta = DB::table("preguntas")->select('id','nPregunta')
        ->orderBy('id','desc')
        ->limit(5)
        ->where('tipo',0)->get();

        return compact("pregunta");
    }



    public function listPreguntaOpcion(){
        $pregunta = DB::table("preguntas")->where('tipo',1)->get()->toArray();
        $detalles = DB::table('detalle_preguntas')->get();
        return compact('pregunta','detalles');
    }

    public function listAlumno(Request $request){
        $alumno = DB::table('personas as p')->join('alumnos as al', 'al.id_persona','=','p.id')
        ->select('p.nombre','p.apelledop','p.apelledom','al.id')
        ->where('al.estadotest','0')
        ->get();
        return compact('alumno');
    }

    public function regRespuesta(Request $request){

        $rpta = $request->data;
        $id_alumno  = $request->id_alumno;
        
        foreach($rpta as $ep=>$det){
        
            $rpta = new Preguntasyrepuestas();
            $rpta->id_pregunta =$det['id'];
            $rpta->respuesta = $det['data'];
            $rpta->id_alumno = $id_alumno;
            $rpta->save();
        }
    }
}
