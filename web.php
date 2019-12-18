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
    return view('welcome');
});

Route::get('/tabela', 'PacijentController@index');
Route::get('/tabela/action', 'PacijentController@action')->name('live_search.action');
Route::get('/tabela/forma', 'PacijentController@forma_osoba_nova'); 
Route::get('/tabela/forma/{id}', 'PacijentController@forma_osoba_stara');

Route::delete('/tabela/{id}', 'PacijentController@osoba_delete');

Route::post('/tabela', 'PacijentController@osoba_nova');  //poziva metodu i kontroler za dodavanje nove osobe
Route::put('/tabela', 'PacijentController@osoba_update');  //update

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


