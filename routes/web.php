<?php

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('admin/sistema/permiso/{nombre?}','PermisoController@index')->name('permiso');
// Route::view('permiso','permiso');


Route::get('/','InicioController@index');

Route::post('iniciar-sesion','InicioController@store');

Route::get('pregunta/rellenar','PreguntaController@listPreguntaRellenar');

Route::get('pregunta/opcion','PreguntaController@listPreguntaOpcion');

Route::post('pregunta','PreguntaController@regRespuesta');

Route::get('alumno','PreguntaController@listAlumno');

