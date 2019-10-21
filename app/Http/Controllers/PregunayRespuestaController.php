<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Preguntasyrepuestas;


class PregunayRespuestaController extends Controller
{
    public function listarPreguntas(Request $request){
        $pregunta = DB::table("preguntas")->where('id','!=',1)->get();
        $detalle = DB::table("detalle_preguntas")->get();
        return compact("pregunta","detalle");
    }

    public function listarDetallePreguntas(Request $request){
        $pregunta = DB::table("preguntas")
        ->where('id','!=',1)
        ->where("tipo",1)->get();
        return compact("pregunta");
    }
}
