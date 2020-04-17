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



Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::resource('/property' , 'PropertiesController',['only' => ['index', 'show', 'store' , 'edit' , 'update' , 'destroy']]);
Route::get('/{email}' , 'HomeController@profile');
// Route::group(['middleware' => 'web', 'prefix' => config('backpack.base.route_prefix')], function () {
//     Route::auth();
//     Route::get('logout', 'Auth\LoginController@logout');
// });

