<?php

use App\Http\Controllers\ResultController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::get('logout', 'Auth\LoginController@logout');

Route::prefix('/')->middleware('auth','has.role')->group(function(){
    Route::get('/', 'DashboardController@index')->name('index');
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('profiles/{user}/questionnaires/{questionnaire}', 'ProfileController@showSurveyResponseByProfile')->middleware('permission:show surveyresponse by profile')->name('profiles.show_surveyresponse_by_profile');
    Route::resource('profiles', 'ProfileController')->middleware('permission:profiles')->only([
        'index', 'edit', 'update'
    ]);
    Route::get('surveys/{questionnaire}-{slug}', 'SurveyController@show')->middleware('permission:show surveys')->name('surveys.show');
    Route::post('surveys/{questionnaire}-{slug}', 'SurveyController@store')->middleware('permission:store surveys')->name('surveys.store');
    Route::resource('surveys', 'SurveyController')->middleware('permission:surveys')->except([
        'show', 'create', 'store', 'edit', 'update'
    ]);
    Route::resource('users', 'UserController')->middleware('permission:users')->except(['show']);
    Route::get('questionnaires/changeStatus', 'QuestionnaireController@changeStatus')->middleware('permission:questionnaires')->name('questionnaires.change_status');
    Route::post('questionnaires/{questionnaire}/questions/{question}', 'QuestionnaireController@assignAnswers')->middleware('permission:assign answers')->name('questionnaires.assign_answers');
    Route::post('questionnaires/{questionnaire}', 'QuestionnaireController@assignQuestions')->middleware('permission:assign questions')->name('questionnaires.assign_questions');
    Route::resource('questionnaires', 'QuestionnaireController')->middleware('permission:questionnaires');
    Route::get('surveyresponses/{questionnaire}/users/{user}', 'SurveyResponseController@showByUser')->middleware('permission:show by user surveyresponses')->name('surveyresponses.show_by_user');
    Route::delete('surveyresponses/{questionnaire}/users/{user}', 'SurveyResponseController@destroyByUser')->middleware('permission:delete by user surveyresponses')->name('surveyresponses.delete_by_user');
    Route::post('surveyresponses/{questionnaire}/calculate', 'SurveyResponseController@calculate')->middleware('permission:calculate surveyresponses')->name('surveyresponses.calculate');
    Route::resource('surveyresponses', 'SurveyResponseController')->middleware('permission:surveyresponses')->only([
        'index', 'show', 'destroy'
    ]);
    Route::get('variables/{questionnaire}/export-pdf', 'VariableController@exportPDF')->middleware('permission:export variables')->name('variables.export_pdf');
    Route::post('variables/{questionnaire}/evaluate', 'VariableController@evaluate')->middleware('permission:evaluate variables')->name('variables.evaluate');
    Route::resource('variables', 'VariableController')->middleware('permission:variables')->only(['index', 'show']);
    Route::get('results/{result}/export-pdf', 'ResultController@exportPDF')->middleware('permission:export results')->name('results.export_pdf');
    Route::resource('results', 'ResultController')->middleware('permission:results')->only([
        'index', 'show'
    ]);
});
