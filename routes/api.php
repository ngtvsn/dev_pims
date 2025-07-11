<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DocumentRecipientController;
use App\Http\Controllers\Api\IssuanceController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/document-recipients', [DocumentRecipientController::class, 'index']);
Route::get('/issuances', [IssuanceController::class, 'data']);
Route::post('/issuances', [IssuanceController::class, 'store']);
