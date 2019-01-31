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
Route::group(['middleware' => ['auth']], function () {
    Route::resource('services','ServiceController');
    Route::resource('statuses','StatusController');
    Route::resource('stages','StageController');
    Route::resource('requests','RequestController');


    Route::get('/requests/approval/{id}','RequestApprovalController@approval')->name('request.approval');


    
    Route::get('', 'HomeController@index')->name('home');
    
});
