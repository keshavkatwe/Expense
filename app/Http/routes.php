<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//
//Route::get('/', function () {
//    return view('auth/login');
//});
Route::get('/', 'Auth\AuthController@getLogin');
Route::get('dashboard', 'Dashboard@index');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


Route::get('add_expense', 'AddExpense@index');
Route::post('add_expense', 'AddExpense@create');
Route::get('edit_expense/{id}', 'AddExpense@edit');
Route::get('delete_expense/{id}', 'AddExpense@destroy');
Route::put('update_expense', 'AddExpense@update');

Route::get('manage_expense', 'AddExpense@view');


Route::get('reports', 'reports@index');
Route::get('reports/search', 'reports@search');