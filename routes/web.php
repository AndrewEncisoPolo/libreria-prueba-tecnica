<?php
use Illuminate\Support\Facades\Route;

Route::get('/', 'inicioController@init');
Route::get('/inicio', 'inicioController@init');
Route::post('/obtener-detalle-libro', 'inicioController@getDetalleLibro')->name('obtener-detalle-libro');

Route::any('/obtener-libros', 'administradorController@obtenerLibros')->name('obtener-libros');
Route::any('/obtener-autores', 'administradorController@obtenerAutores')->name('obtener-autores');
Route::any('/obtener-editoriales', 'administradorController@obtenerEditoriales')->name('obtener-editoriales');

Route::any('/registrar-libro', 'administradorController@registrarLibro')->name('registrar-libro');
Route::any('/registrar-editorial', 'administradorController@registrarEditorial')->name('registrar-editorial');
Route::any('/registrar-autor', 'administradorController@registrarAutor')->name('registrar-autor');

Route::get('/adm-libro', 'administradorController@initLibro');
Route::get('/adm-autor', 'administradorController@initAutor');
Route::get('/adm-editorial', 'administradorController@initEditorial');
