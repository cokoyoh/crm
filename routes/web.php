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

Route::get('/companies/{company}/profiles', 'CompanyProfilesController@complete')->name('companies.profiles.complete');
Route::get('/users/{user}/profile', 'UsersController@profile')->name('users.profile');
Route::post('/users/{user}/update', 'UsersController@update')->name('users.update');

Route::group(['middleware' => ['guest']], function () {
    Route::post('/companies/{company}/profiles', 'CompanyProfilesController@store')->name('companies.profiles.store');
});

Route::group(['middleware' => ['auth']], function (){
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/companies', 'CompaniesController@index')->name('companies.index');
    Route::get('/companies/create', 'CompaniesController@create')->name('companies.create');
    Route::get('/companies/{company}/show', 'CompaniesController@show')->name('companies.show');
    Route::post('/companies', 'CompaniesController@store')->name('companies.store');

    Route::get('/companies/{company}/users/invites', 'UsersController@invite')->name('users.invite');
    Route::post('/companies/{company}/users/invites', 'UsersController@storeInvitedUser')->name('users.invite.store');

    Route::get('/users', 'UsersController@index')->name('users.index');
    Route::get('/get-company-users', 'UsersController@getCompanyUsers');
    Route::delete('/users/{user}/destroy', 'UsersController@destroy')->name('users.destroy');

    Route::get('/dashboard', 'DashboardController@superAdmin')->name('dashboard.superadmin');
    Route::get('/dashboard/{user}/admin', 'DashboardController@admin')->name('dashboard.admin');
    Route::get('/dashboard/{user}/user', 'DashboardController@user')->name('dashboard.user');

    Route::get('/leads', 'LeadsController@index')->name('leads.index');
    Route::get('/leads/create/{lead?}', 'LeadsController@create')->name('leads.create');
    Route::get('/leads/{lead}/show', 'LeadsController@show')->name('leads.show');
    Route::post('/leads', 'LeadsController@store')->name('leads.store');

    Route::get('/leads/assigned', 'LeadsController@assigned')->name('leads.assigned');
    Route::get('/leads/converted', 'LeadsController@converted')->name('leads.converted');
    Route::get('/leads/lost', 'LeadsController@lost')->name('leads.lost');
    Route::get('/apis/leads', 'Apis\LeadsController@leads');
    Route::get('/apis/leads/assigned', 'Apis\LeadsController@assigned');
    Route::get('/apis/leads/converted', 'Apis\LeadsController@converted');
    Route::get('/apis/leads/lost', 'Apis\LeadsController@lost');

    Route::post('/leads/{lead}/reassign', 'LeadsController@reassign')->name('leads.reassign');
    Route::get('/get-leads', 'LeadsController@getLeads')->name('leads.fetch-leads');

    Route::get('/leads/check-email', 'ConfirmLeadsController@email')->name('leads.confirm-email');
    Route::get('/leads/check-phone', 'ConfirmLeadsController@phone')->name('leads.confirm-phone');

    Route::get('/leads/{lead}/lost', 'LeadsController@markAsLost')->name('leads.mark-as-lost');
    Route::get('/leads/{lead}/convert', 'LeadsController@convert')->name('leads.convert');
    Route::delete('/leads/{lead}/destroy', 'LeadsController@destroy')->name('leads.destroy');

    Route::post('/leads/{lead}/notes', 'LeadNotesController@store')->name('leads.notes.store');

    Route::get('/lead-sources', 'LeadSourcesController@index')->name('lead-sources.index');
    Route::post('/lead-sources', 'LeadSourcesController@store')->name('lead-sources.store');
    Route::get('/get-company-sources', 'LeadSourcesController@sources');

    Route::post('/schedules', 'SchedulesController@store')->name('schedules.store');
    Route::delete('/schedules/{schedule}/destroy', 'SchedulesController@destroy')->name('schedules.destroy');

    Route::post('/interactions/{lead}/store', 'InteractionsController@store')->name('interactions.store');
    Route::delete('/interactions/{interaction}/destroy', 'InteractionsController@destroy')->name('interactions.destroy');

    Route::post('/products', 'ProductsController@store')->name('products.store');
});

