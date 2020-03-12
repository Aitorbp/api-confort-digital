<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user', 'UserController@createUser' );
Route::post('/user/generateToken/{id}', 'UserController@generateToken' );
Route::get('/users', 'UserController@getUsers' );
Route::post('/user/login', 'UserController@loginUser');
Route::get('/user/{id}', 'UserController@getUser' );
Route::post('/user/password/reset', 'UserController@sendMail' );




Route::post('/app', 'CSVController@createAppData' );


//Restrictions
Route::post('/restriction/create', 'restrictionController@createRestriction' );
Route::get('/restriction/show/', 'restrictionController@showRestriction' );
Route::post('/restriction/update', 'restrictionController@updateRestriction' );
Route::delete('/restriction/delete', 'restrictionController@updateRestriction' );

//Applications
Route::get('/application/show', 'applicationController@getAllApplications' );
