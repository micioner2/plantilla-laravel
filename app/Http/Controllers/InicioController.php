<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginFormRequest;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InicioController extends Controller
{
    public function index()
    {
        return view("inicio");
    }

    public function store(LoginFormRequest $request){

        // if (Auth::attempt(['numeroide' => $request->usuario, 'numeroide' => $request->clave], false)) {
        //     return response($request->all(), 200);
        //     dd();
        // }else{
        //     // return response(['errors' => ['login' => ['Los datos que ingresastes son incorrectos']]],422);
     
        // }
        
        $usuario = $request->usuario;
        $sesion = DB::table('personas as perpa')->join('padres as pd','pd.id_persona','=','perpa.id')
        ->join('alumnos as al', 'al.id_padre','=','pd.id')->join('personas as peral','peral.id','=','al.id_persona')
        ->select('perpa.nombre as padre','peral.nombre as hijo')
        ->where('perpa.numeroide',$usuario)->get();

     

        return compact('sesion');

    }
}
