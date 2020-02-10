<?php

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

Route::post('user/attach/{user_id}/{group_id}', 'UserController@addToGroup');
Route::post('user/detach/{user_id}/{group_id}', 'UserController@removeFromGroup');

Route::get('groups', 'GroupController@index');
Route::get('group/{id}', 'GroupController@show');
Route::post('group', 'GroupController@store');
Route::put('group', 'GroupController@store');
Route::delete('group/{id}', 'GroupController@destroy');

