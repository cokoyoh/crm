<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['guest']], function(){
    Route::get('/lead-sources/{company}', 'Apis\LeadsController@companyLeadSources');
    Route::get('/leads/{user}', 'Apis\LeadsController@leads');
    Route::get('/leads/{lead}/interactions', 'Apis\LeadsController@interactions');

    Route::get('/users/{user}', 'Apis\UserController@users');
});
