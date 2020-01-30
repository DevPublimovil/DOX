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




Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/flight', 'FlightController');

//rutas para documentos
Route::resource('/documentos', 'DocumentosController');


//rutas para entregas
Route::resource('/entregas', 'EntregasController');
Route::get('/apientregas', 'EntregasController@listEntregas')->name('entregas.list');


//rutas para exluidos
Route::resource('/excluidos', 'ExcluidosController');
Route::get('/apiexcluidos', 'ExcluidosController@listentregados')->name('excluidos.list');
