<?php

use Illuminate\Support\Facades\Route;


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

/* Route::get('/', function() {
    return view('index');
});
*/
Route::resource('/', 'UserController');
Route::post('/Auth','UserController@auth');
Route::get('/Cadastrar', 'UserController@create');
Route::resource('/Clientes', 'ClienteController');
Route::resource('/Books', 'BookController');


?>