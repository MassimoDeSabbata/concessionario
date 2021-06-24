<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EstimateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::middleware(['auth:sanctum'])->group(function () {

    Route::apiResource('estimates', EstimateController::class)->only([
        'index', 'show', 'store', 'update', 'destroy'
    ]);


Route::get('estimates/{estimate}/send', [EstimateController::class, 'send_estimate']);
});




Route::post('/login', [AuthController::class, 'login']);


Route::get('pippo/lalala', [EstimateController::class, 'pippo']);
