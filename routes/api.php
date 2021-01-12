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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api'], function() {
    Route::post('/add', 'App\Http\Controllers\HelloController@add');
    Route::delete('/delete/{id}', 'App\Http\Controllers\HelloController@del');
    Route::get('/get_data_tbl', 'App\Http\Controllers\HelloController@get_data_tbl');
});

Route::get('/test', 'App\Http\Controllers\HelloController@show');

Route::post('/form_js_add', "App\Http\Controllers\HelloController@ajax_add");