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
Route::get('/reports', 'HomeController@viewReports');
/*
========
TYPE
========
*/
Route::post('/get-type', 'HomeController@getTypes');
Route::post('/type', 'HomeController@storeType');
Route::post('/type/{id}', 'HomeController@updateType');
Route::post('/type/delete/{id}', 'HomeController@deleteType');

/*
========
MASTER
========
*/
Route::post('/get-master', 'HomeController@getMaster');
Route::post('/master', 'HomeController@storeMaster');
Route::post('/master/{id}', 'HomeController@updateMaster');
Route::post('/master/delete/{id}', 'HomeController@deleteMaster');

