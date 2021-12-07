<?php

use App\Http\Controllers\CakeController;
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

Route::group(['prefix' => 'cakes'], function () {
    Route::get('', [CakeController::class, 'index']);
    Route::get('/{id}', [CakeController::class, 'show']);
    Route::post('', [CakeController::class, 'store']);
    Route::put('/{id}', [CakeController::class, 'update']);
    Route::delete('/{id}', [CakeController::class, 'destroy']);
});
