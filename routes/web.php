<?php

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('admin/sistema/permiso/{nombre?}','PermisoController@index')->name('permiso');
// Route::view('permiso','permiso');


Route::get('/','InicioController@index');

Route::post('iniciar-sesion','InicioController@store');

Route::get('cuestionario/pregunta','CuestionarioController@listPreguntas');

Route::post('cuestionario/pregunta','CuestionarioController@regRespuesta');

Route::get('cuestionario/alumno','CuestionarioController@listAlumno');


// 
Route::get('test/pregunta','TestController@listPreguntas');

Route::post('test/pregunta','TestController@regRespuesta');

Route::get('test/alumno','TestController@listAlumno');


