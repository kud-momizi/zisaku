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

Route::group(['middleware' => 'role:2'], function () {
    // 医療機関ユーザーのみアクセス可能なルート
    Route::get('/hospitals_home', 'HospitalsController@index')->name('hospitals.home')->middleware('auth');
    Route::get('/hospitals_create', 'HospitalsController@create')->name('hospitals.create');
    Route::post('/hospitals', 'HospitalsController@store')->name('hospitals.store');
    Route::get('/hospitals_edit/{hospital_id}', 'HospitalsController@edit')->name('hospitals.edit');
    Route::put('/hospitals_edit/{hospital_id}', 'HospitalsController@update')->name('hospitals.update');
    Route::post('hospitals/{hospital}/tags/add', 'HospitalsController@addTag')->name('hospitals.tags.add');
    Route::get('/reservations', 'HospitalsController@showReservationIndex')->name('reservations.index');

    Route::get('/availabilities_create/{hospital_id}', 'AvailabilityController@create')->name('availabilities.create');
    Route::post('/availabilities_create/{hospital_id}', 'AvailabilityController@store')->name('availabilities.store');

    Route::get('/availabilities_edit/{availability_id}', 'AvailabilityController@edit')->name('availabilities.edit');
    Route::put('/availabilities_edit/{availability_id}', 'AvailabilityController@update')->name('availabilities.update');
});

Route::group(['middleware' => 'role:1'], function () {
    // 一般ユーザーのみアクセス可能なルート
    Route::get('/users_home', 'UsersController@home')->name('users.home');
    Route::get('/hospitals/search', 'UsersController@search')->name('hospitals.search');
    Route::get('/hospitals/{hospital}', 'UsersController@show')->name('hospitals.show');

    Route::get('/reservations/create/{hospital}', 'ReservationsController@create')->name('reservations.create');
    Route::post('/reservations', 'ReservationsController@store')->name('reservations.store');
    Route::delete('/reservations/{id}/cancel', 'UsersController@cancelReservation')->name('reservations.cancel');
});

Route::group(['middleware' => 'role:0'], function () {
    // 管理者ユーザーのみアクセス可能なルート
    Route::get('/admins_home', 'AdminsController@home')->name('admins.home');
    Route::get('/admins/search', 'AdminsController@search')->name('admins.search');
    Route::get('/admins/{hospital}', 'AdminsController@show')->name('admins.show');
    Route::get('/admins', 'UsersController@index')->name('users.index');
    Route::delete('/admins_index/{user}', 'UsersController@destroy')->name('users.destroy');
    Route::delete('/admins/{hospital}', 'HospitalsController@destroy')->name('hospitals.destroy');

    Route::resource('tags', 'TagController')->except(['index', 'show']);
    Route::get('tags_create', 'TagController@create')->name('tags.create');
    Route::get('tags_index', 'TagController@index')->name('tags.index');
});
