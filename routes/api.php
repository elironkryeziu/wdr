<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//auth
Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');

Route::group(['middleware' => 'auth:api'], function () {

//auth
Route::post('/logout', 'AuthController@logout');
Route::post('/pwdchange', 'AuthController@changePassword');
Route::get('/user', 'AuthController@user');

//AW
Route::get('/aws', 'AwController@index');
Route::get('/aw/{id}', 'AwController@show');
Route::put('/aw/{id}', 'AwController@update');

//Default Tasks
Route::get('/default-tasks', 'DefaultTaskController@index');
Route::get('/default-task/{id}', 'DefaultTaskController@show');
Route::post('/default-tasks', 'DefaultTaskController@store');
Route::put('/default-task/{id}', 'DefaultTaskController@update');
Route::delete('/default-task/{id}', 'DefaultTaskController@destroy');

//Pauses
Route::get('/pauses', 'PauseController@index');
Route::get('/pause/{id}', 'PauseController@show');
Route::post('/pauses', 'PauseController@store');
Route::put('/pause/{id}', 'PauseController@update');
Route::delete('/pause/{id}', 'PauseController@destroy');

//Plans
Route::get('/plans', 'PlanController@index');
Route::get('/plan/{id}', 'PlanController@show');
Route::put('/plan/{id}', 'PlanController@update');

//Tasks
Route::get('/tasks', 'TaskController@index');
Route::get('/task/{id}', 'TaskController@show');
Route::post('/tasks', 'TaskController@store');
Route::put('/task/{id}', 'TaskController@update');
Route::delete('/task/{id}', 'TaskController@destroy');

//Usual Tasks
Route::get('/usual-tasks', 'UsualTaskController@index');
Route::get('/usual-task/{id}', 'UsualTaskController@show');
Route::post('/usual-tasks', 'UsualTaskController@store');
Route::put('/usual-task/{id}', 'UsualTaskController@update');
Route::delete('/usual-tasks/{id}', 'UsualTaskController@destroy');

//Workers
Route::get('/workers', 'WorkerController@index');
Route::get('/worker/{id}', 'WorkerController@show');
Route::post('/workers', 'WorkerController@store');
Route::put('/usual-task/{id}', 'WorkerController@update');
Route::delete('/usual-tasks/{id}', 'WorkerController@destroy');
});


