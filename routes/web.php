<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});




Route::group(['middleware' => ['auth']], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/variablessystem', 'HomeController@arraysSystem')->name('home.variables');
    Route::get('/publimovil', 'HomeController@contactar')->name('home.contactar');

    //rutas para documentos
    Route::resource('/documentos', 'DocumentosController');


    //rutas para entregas
    Route::resource('/entregas', 'EntregasController');
    Route::get('/apientregas', 'EntregasController@listEntregas')->name('entregas.list');


    //rutas para exluidos
    Route::resource('/excluidos', 'ExcluidosController');
    Route::get('/apiexcluidos', 'ExcluidosController@listentregados')->name('excluidos.list');

    //rutas para emails
    Route::get('/sendemails/{id}', 'EmailsController@enviar')->name('emails.send');


    //rutas para directorio telefonico
    Route::resource('/contactos', 'DirectorioController');
    Route::get('/apicontactos', 'DirectorioController@listcontactos')->name('contactos.list');

    //rutas para usuarios
    Route::resource('/users', 'UserController');

    //rutas para agenda
    Route::resource('/agendas', 'AgendaController');
    Route::get('/apiagendas', 'AgendaController@getAgenda')->name('agendas.list');
    Route::delete('/etiquetas/{id}', 'AgendaController@deleteEtiqueta')->name('etiqueta.destroy');
    Route::post('/etiquetas', 'AgendaController@addEtiqueta')->name('etiqueta.store');
});