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
Route::get('/companies/{company}/profiles', 'CompanyProfilesController@complete')->name('companies.profiles.complete');

Route::group(['middleware' => ['guest']], function () {
    Route::post('/companies/{company}/profiles', 'CompanyProfilesController@store')->name('companies.profiles.store');
});

Route::group(['middleware' => ['auth']], function (){
    Route::get('/companies', 'CompaniesController@index')->name('companies.index');
    Route::get('/companies/create', 'CompaniesController@create')->name('companies.create');
    Route::get('/companies/{company}/show', 'CompaniesController@show')->name('companies.show');
    Route::post('/companies', 'CompaniesController@store')->name('companies.store');

    Route::post('/companies/{company}/invites', 'CompaniesController@invites')->name('companies.users.invite');
});

