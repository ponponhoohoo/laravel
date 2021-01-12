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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/index', 'App\Http\Controllers\HelloController@index');
Route::get('/', 'App\Http\Controllers\HelloController@index');

//一覧
Route::get('/list', "App\Http\Controllers\HelloController@list")->name("list");
//編集
Route::get('/edit/{id}', 'App\Http\Controllers\HelloController@edit')->name("edit");;
Route::post('/edit', "App\Http\Controllers\HelloController@edit_post")->name("edit.post");
Route::get('/edit_confirm', 'App\Http\Controllers\HelloController@edit_confirm')->name("edit.confirm");
Route::post('/edit_end', 'App\Http\Controllers\HelloController@edit_end')->name("edit.end");

//削除
Route::get('/del/{id}', 'App\Http\Controllers\HelloController@del')->name("del");;
Route::post('/del_end', 'App\Http\Controllers\HelloController@del_end')->name("del.end");

//フォーム表示
Route::get('/form', "App\Http\Controllers\HelloController@form")->name("form.show");
//POST送信時
Route::post('/form', "App\Http\Controllers\HelloController@post")->name("form.post");

Route::get('/confirm', "App\Http\Controllers\HelloController@confirm")->name("form.confirm");

Route::post('/send', "App\Http\Controllers\HelloController@send")->name("form.send");
//composer require "laravelcollective/html" 


//vue
// Route::post('/add', 'App\Http\Controllers\HelloController@add')->name("vue.add");

//フォーム表示
Route::get('/form_js', "App\Http\Controllers\HelloController@form_js");
