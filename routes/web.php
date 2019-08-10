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
    return view('shapes');
});


Route::get('/shape', 'ShapeController@index');


Route::get('guess', 'EventController@getEvent');

Route::post('guess', 'EventController@setEvent');

