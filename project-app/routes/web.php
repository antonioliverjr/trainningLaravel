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
Route::resource('/', 'LoginController');
Route::post('/Auth','LoginController@authenticate');

Route::middleware(['auth'])->group(function(){
    Route::get('/Logout', 'LoginController@logout');
    Route::resource('/User', 'UserController');
    Route::resource('/Clientes', 'ClienteController');
    Route::resource('/Books', 'BookController');
});

Route::get('/', 'LoginController@index')->name('login');

##Route::get('/Logout', 'LoginController@logout');
##Route::resource('/User', 'UserController');
##Route::resource('/Clientes', 'ClienteController');
##Route::resource('/Books', 'BookController');


?>