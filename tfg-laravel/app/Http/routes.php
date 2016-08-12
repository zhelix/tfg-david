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

/*
Route::get('/', function () {
    return view('welcome');
});
*/


//Get Data
Route::get('/call', 'getDataController@setData');

//Login
Route::get('/', ['uses' => 'HomeController@index', 'middleware' => 'auth']);

//Users
Route::get('/user', ['uses' => 'HomeController@index', 'middleware' => 'auth']);
Route::get('/', ['uses' => 'HomeController@index', 'middleware' => 'auth']);

//Edit User info
Route::get('/user/editinfo', ['uses' => 'HomeController@edit', 'middleware' => 'auth']);
Route::post('/save', ['uses' => 'HomeController@saveChanges', 'middleware' => 'auth']);

//Add new board
Route::get('/user/addboard', ['uses' => 'HomeController@addBoard', 'middleware' => 'auth']);
Route::post('/addB', ['uses' => 'HomeController@addNewBoard', 'middleware' => 'auth']);

//Reports
Route::get('/report', ['uses' => 'reportController@index', 'middleware' => 'auth']);

//Generate Reports Files
Route::get('/txt', ['uses' => 'reportController@generateTxt', 'middleware' => 'auth']);
Route::get('/txt1', ['uses' =>'reportController@getValueRealTime']);
//Route::get('txt', 'reportController@generateTxt');
Route::get('/csv', ['uses' => 'reportController@generateCsv', 'middleware' => 'auth']);
//Route::get('csv', 'reportController@generateCsv');
Route::post('/generate', ['uses' => 'reportController@generateReport', 'middleware' => 'auth']);

Route::get('test', function () {
    return view('pages.testing');
});

Route::get('foo', function () {
    return 'Bar';
});

Route::auth();

Route::get('/', 'HomeController@index');


Route::auth();

Route::get('/home', 'HomeController@index');


