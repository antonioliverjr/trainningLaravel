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
Route::resource('/User', 'UserController');
Route::post('/Auth','LoginController@authenticate');

Route::middleware(['auth'])->group(function(){
    Route::resource('/Books', 'BookController');
    Route::resource('/Clientes', 'ClienteController');
    Route::get('/Logout', 'LoginController@logout');
    Route::get('/Inactive', 'UserController@inactive');
    Route::get('/Inactive/Restore/{id}', 'UserController@restoreUser');
    Route::get('/Records', 'BookController@records');
    Route::post('/Search', 'BookController@searchBook');
});

Route::get('/', 'LoginController@index')->name('login');

##Route::get('/Logout', 'LoginController@logout');
##Route::resource('/User', 'UserController');
##Route::resource('/Clientes', 'ClienteController');
##Route::resource('/Books', 'BookController');


?>