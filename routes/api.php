<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
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

Route::post("login", [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(
    function () {
        Route::get("messages", [MessageController::class, 'index']);
        Route::get("message/{id}", [MessageController::class, 'show']);
        Route::post("logout", [AuthController::class, 'logout']);
    }
);


// Route::prefix('v1')->group(
//     function () {
//         Route::get("messages", [MessageController::class, 'index']);
//         Route::get("message/{id}", [MessageController::class, 'show']);
//     }
// );
