<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


//usuarios
Route::get('user', 'UserController@index');
Route::get('userImg','UserController@getUserImage');

//boars
Route::get('board', 'BoardController@index');

//Reportes
Route::get('report', 'ReportController@index');

//Recive datos
Route::get('/call','getDataController@pickData');
//Post solve CSRF
Route::post('/send','BoardController@monitorize');
/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('test', function () {
    return view('pages.testing');
});

Route::get('foo', function(){
    return 'Bar';
});

Route::auth();

Route::get('/home', 'HomeController@index');
