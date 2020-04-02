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

// inseriamo le rotte guest
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

// inseriamo le rotte admin
Route::name('admin.')->namespace('Admin')->middleware('auth')->prefix('admin')->group(function () {
    Route::resource('categories','CategoryController');
    Route::resource('arguments','ArgumentController');
    Route::resource('articles','ArticleController');
});

