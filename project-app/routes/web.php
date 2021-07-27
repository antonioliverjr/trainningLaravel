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

Route::middleware('admin')->group(function(){
    Route::resource('/User', 'UserController');
    Route::get('/Inactive', 'UserController@inactive');
    Route::get('/Inactive/Restore/{id}', 'UserController@restoreUser');
});

Route::middleware('manager')->group(function(){
    Route::get('/Records', 'BookController@records');
});

Route::middleware(['auth'])->group(function(){
    Route::resource('/Clientes', 'ClienteController');
    Route::resource('/Books', 'BookController');
    Route::get('/Logout', 'LoginController@logout');
    Route::post('/Search', 'BookController@searchBook');
});

Route::middleware(['auth'])->group(function(){
    Route::resource('/Cart', 'CartController');
    Route::get('/History', 'CartController@purchases');
    Route::post('/Cart/Add', 'CartController@store');
    Route::post('/Cart/Remove', 'CartController@destroy');
    Route::post('/Canceled', 'CartController@canceled');
});

Route::get('/', 'LoginController@index')->name('login');

##Route::get('/Logout', 'LoginController@logout');
##Route::resource('/User', 'UserController');
##Route::resource('/Clientes', 'ClienteController');
##Route::resource('/Books', 'BookController');


?>