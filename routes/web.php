<?php

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'ApplicationFormController@create')->name('application.form');
Route::post('application-form', 'ApplicationFormController@store')->name('application_form.store');

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', 'AuthController@validateAuth')->name('validateAuth');
    Route::resource('users', 'UsersController', ['except' => ['show']]);
    Route::resource('user-profile', 'ProfileController', ['only' => ['edit', 'update']]);

    Route::resource('applicants', 'ApplicantsController', ['except' => ['index']]);
    Route::get('applicants', 'ApplicantsController@index')->name('applicants.index');

    Route::resource('cancel-application', 'CancelApplicationController', ['only' => ['edit']]);

    Route::resource('scheduleForExamination', 'ScheduleForExaminationController', ['only' => ['store']]);
    Route::get('examinationResults/{applicantID}/{status}', 'ExaminationResultsController@edit')->name('examinationResults.edit');
    Route::get('finalInterviewResults/{applicationID}/{status}', 'FinalInterviewResultsController@edit')->name('finalInterviewResults.edit');

    Route::resource('reports', 'ReportsController');
    Route::resource('positions', 'PositionController');
});
