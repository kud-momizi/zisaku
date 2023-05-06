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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/hospitals_home', 'HospitalsController@index')->name('hospitals.home')->middleware('auth');
Route::get('/hospitals_create', 'HospitalsController@create')->name('hospitals.create');
Route::post('/hospitals', 'HospitalsController@store')->name('hospitals.store');