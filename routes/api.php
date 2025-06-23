<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Pages\Css\Results\CssResults;
use App\Http\Livewire\Pages\Css\Results\CssResultsTransactingOffice;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get("respondents_sex_filter/{year}/{report_type_id}", [CssResults::class, 'respondents_sex_filter']);
Route::get("respondents_client_group_filter/{year}/{report_type_id}", [CssResults::class, 'respondents_client_group_filter']);
Route::get("respondents_client_type_filter/{year}/{report_type_id}", [CssResults::class, 'respondents_client_type_filter']);
Route::get("respondents_region_filter/{year}/{report_type_id}", [CssResults::class, 'respondents_region_filter']);
Route::get("respondents_awareness_response_filter/{year}/{report_type_id}", [CssResults::class, 'respondents_awareness_response_filter']);
Route::get("respondents_visibility_response_filter/{year}/{report_type_id}", [CssResults::class, 'respondents_visibility_response_filter']);
Route::get("respondents_helpfulness_response_filter/{year}/{report_type_id}", [CssResults::class, 'respondents_helpfulness_response_filter']);
Route::get("respondents_availed_service_filter/{year}/{report_type_id}", [CssResults::class, 'respondents_availed_service_filter']);
Route::get("respondents_transacting_office_filter/{year}/{report_type_id}", [CssResults::class, 'respondents_transacting_office_filter']);

Route::get("respondents_sex/{year}", [CssResults::class, 'respondents_sex']);
Route::get("respondents_client_group/{year}", [CssResults::class, 'respondents_client_group']);
Route::get("respondents_client_type/{year}", [CssResults::class, 'respondents_client_type']);
Route::get("respondents_region/{year}", [CssResults::class, 'respondents_region']);
Route::get("respondents_awareness_response/{year}", [CssResults::class, 'respondents_awareness_response']);
Route::get("respondents_visibility_response/{year}", [CssResults::class, 'respondents_visibility_response']);
Route::get("respondents_helpfulness_response/{year}", [CssResults::class, 'respondents_helpfulness_response']);
Route::get("respondents_availed_service/{year}", [CssResults::class, 'respondents_availed_service']);
Route::get("respondents_transacting_office/{year}", [CssResults::class, 'respondents_transacting_office']);
Route::get("ratings/{year}", [CssResults::class, 'ratings']);
Route::get("average/{year}", [CssResults::class, 'average']);

Route::get("respondents_sex_transacting_office/{year}/{office}", [CssResultsTransactingOffice::class, 'respondents_sex_transacting_office']);
Route::get("respondents_client_group_transacting_office/{year}/{office}", [CssResultsTransactingOffice::class, 'respondents_client_group_transacting_office']);
Route::get("respondents_client_type_transacting_office/{year}/{office}", [CssResultsTransactingOffice::class, 'respondents_client_type_transacting_office']);
Route::get("respondents_region_transacting_office/{year}/{office}", [CssResultsTransactingOffice::class, 'respondents_region_transacting_office']);
Route::get("respondents_awareness_response_transacting_office/{year}/{office}", [CssResultsTransactingOffice::class, 'respondents_awareness_response_transacting_office']);
Route::get("respondents_visibility_response_transacting_office/{year}/{office}", [CssResultsTransactingOffice::class, 'respondents_visibility_response_transacting_office']);
Route::get("respondents_helpfulness_response_transacting_office/{year}/{office}", [CssResultsTransactingOffice::class, 'respondents_helpfulness_response_transacting_office']);
Route::get("respondents_availed_service_transacting_office/{year}/{office}", [CssResultsTransactingOffice::class, 'respondents_availed_service_transacting_office']);
Route::get("ratings_transacting_office/{year}/{office}", [CssResultsTransactingOffice::class, 'ratings_transacting_office']);
Route::get("average_transacting_office/{year}/{office}", [CssResultsTransactingOffice::class, 'average_transacting_office']);


