<?php


Route::get('/', function () {
    return view('welcome');
});
// Route::get('/usuarios', 'AlumnosController@index');
Route::get('/usuarios', function () {
    return view('menu');
});
Route::get('/alumnos', function () {
    return view('Alumnos');
});
Route::get('/alumnos/especialidad/{especialidad}', function ($nombreEsp) {
    return view('AlumnosProgramacion')->with('especialidad',$nombreEsp);
});
Route::get('/alumnos/especialidad/1/{grupo}', function ($idGrupo) {
    return view('AlumnosGeneral')->with('grupo',$idGrupo);
});
Route::get('/infoalumno', 'AlumnosController@InfoAlumno');
Route::get('/correo', 'AlumnosController@correo')->name('correo');
Route::get('/suspencion', 'AlumnosController@suspencion')->name('suspencion');
Route::post('/pdf', 'AlumnosController@PDF');
Route::post('/pdf2', 'AlumnosController@PDF2');
Route::get('/alumnos/perfil/{curp}', function ($curp) {
    return view('AlumnoPerfil')->with('curp',$curp);
});
Route::get('/avisos', function () {
    return view('avisos');
});
Route::get('/mandaraviso', 'AvisosController@aviso');
Route::get('/mandar', 'AvisosController@mandar');
Route::get('/editar', 'AvisosController@editar');
Route::get('/actualizar', 'AvisosController@actualizar');
Route::get('/borrar', 'AvisosController@borrar');
