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
Route::get('/users/{user}/profile', 'UsersController@profile')->name('users.profile');
Route::post('/users/{user}/update', 'UsersController@update')->name('users.update');

Route::group(['middleware' => ['guest']], function () {
    Route::post('/companies/{company}/profiles', 'CompanyProfilesController@store')->name('companies.profiles.store');
});

Route::group(['middleware' => ['auth']], function (){
    Route::get('/companies', 'CompaniesController@index')->name('companies.index');
    Route::get('/companies/create', 'CompaniesController@create')->name('companies.create');
    Route::get('/companies/{company}/show', 'CompaniesController@show')->name('companies.show');
    Route::post('/companies', 'CompaniesController@store')->name('companies.store');

    Route::get('/companies/{company}/users/invites', 'UsersController@invite')->name('users.invite');
    Route::post('/companies/{company}/users/invites', 'UsersController@storeInvitedUser')->name('users.invite.store');

    Route::delete('/users/{user}/destroy', 'UsersController@destroy')->name('users.destroy');

    Route::get('/dashboard', 'DashboardController@superAdmin')->name('dashboard.superadmin');
    Route::get('/dashboard/{user}/admin', 'DashboardController@admin')->name('dashboard.admin');
    Route::get('/dashboard/{user}/user', 'DashboardController@user')->name('dashboard.user');

    Route::get('/leads/{lead}/show', 'LeadsController@show')->name('leads.show');
    Route::post('/leads', 'LeadsController@store')->name('leads.store');
    Route::get('/get-leads', 'LeadsController@getLeads')->name('leads.fetch-leads');

    Route::post('/leads/{lead}/notes', 'LeadNotesController@store')->name('leads.notes.store');

    Route::post('/schedules', 'SchedulesController@store')->name('schedules.store');
    Route::delete('/schedules/{schedule}/destroy', 'SchedulesController@destroy')->name('schedules.destroy');

    Route::post('/interactions/{lead}/store', 'InteractionsController@store')->name('interactions.store');
});

