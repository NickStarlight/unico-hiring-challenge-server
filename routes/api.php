<?php

use App\Http\Controllers\FairController;
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

/** API version V1 */
Route::prefix('v1')->group(function () {
    /** Fair endpoints */
    Route::apiResource('fair', FairController::class);
});
