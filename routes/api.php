<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users', 'UserController@index');
Route::get('user/{id}', 'UserController@show');
Route::post('user', 'UserController@store');
Route::put('user', 'UserController@store');
Route::delete('user/{id}', 'UserController@destroy');


Route::get('groups', 'GroupController@index');
Route::get('group/{id}', 'GroupController@show');
Route::post('group', 'GroupController@store');
Route::put('group', 'GroupController@store');
Route::delete('group/{id}', 'GroupController@destroy');
