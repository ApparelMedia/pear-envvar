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

Route::resource('connections', 'ConnectionController');
Route::resource('projects', 'ProjectController');
Route::resource('envvars', 'EnvvarController');

Route::get('api/connections/{id}/check', function ($id) {
    $connection = \App\Connection::find($id);
    $success = (new \App\Checkers\ConnectionSuccessfulChecker($connection))->check();
    return response()->json(['data' => compact('success')]);
});