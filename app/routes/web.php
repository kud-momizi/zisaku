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
Route::get('/hospitals_edit/{hospital_id}', 'HospitalsController@edit')->name('hospitals.edit');
Route::put('/hospitals_edit/{hospital_id}', 'HospitalsController@update')->name('hospitals.update');

Route::get('/availabilities_create/{hospital_id}', 'AvailabilityController@create')->name('availabilities.create');
Route::post('/availabilities_create/{hospital_id}', 'AvailabilityController@store')->name('availabilities.store');

Route::get('/availabilities_edit/{hospital_id}', 'AvailabilityController@edit')->name('availabilities.edit');
Route::put('/availabilities_edit/{hospital_id}', 'AvailabilityController@update')->name('availabilities.update');

