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
    Route::resource('requestApprovals','RequestApprovalController');
    Route::resource('incidents','IncidentController');
    Route::resource('incidentApprovals', 'IncidentApprovalController');
    Route::put('/incident/{incident}/detailsave', 'IncidentController@detailsave')->name('incidents.detailsave');
    Route::get('/incident/{incident}/detailshow', 'IncidentController@detailshow')->name('incidents.detailshow');
    Route::get('/incident/{incident}/approve/show', 'IncidentController@approveshow')->name('incidents.approveshow');
    Route::get('/incident/{incident}/reject/show', 'IncidentController@rejectshow')->name('incidents.rejectshow');
    Route::get('/incident/{incident}/ticket/show', 'IncidentController@ticketshow')->name('incidents.approveshow');
    Route::get('/incident/{incident}/ticket/create', 'IncidentController@ticketcreated')->name('incidents.rejectshow');

    Route::put('/requests/{request}/approvesave', 'RequestController@approvesave')->name('requests.approvesave');
    Route::get('/requests/{request}/approveshow', 'RequestController@approveshow')->name('requests.approveshow');
    Route::put('/requests/{request}/soapprove', 'RequestController@soapprove')->name('requests.soapprove');
    Route::get('/requests/{request}/edit/detail', 'RequestController@editdetail')->name('requests.editdetail');
    Route::put('/requests/{request}/updatedetail', 'RequestController@updatedetail')->name('requests.updatedetail');
    Route::get('/requests/{request}/edit/reject', 'RequestController@editreject')->name('requests.editreject');
    Route::put('/requests/{request}/so/update/reject', 'RequestController@soreject')->name('requests.soreject');
    Route::put('/requests/{request}/boss/update/reject', 'RequestController@bossreject')->name('requests.bossreject');
    Route::put('/requests/{request}/employee/approve', 'RequestController@employeeapprove')->name('requests.employeeapprove');
    Route::put('/requests/{request}/spsd/approve', 'RequestController@spictapprove')->name('requests.spictapprove');
    Route::put('/requests/{request}/spict/approve', 'RequestController@spsdapprove')->name('requests.spsdapprove');
    Route::get('/requests/{request}/esklasi/so', 'RequestController@eskalasiso')->name('requests.eskalasiso');
    Route::get('', 'HomeController@index')->name('home');
});
