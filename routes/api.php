<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

//Route::middleware('auth')->group(function () {
    Route::middleware(['auth', 'verified'])->get('tickets', [AuthController::class, 'getTickets']);

    Route::middleware(['auth', 'verified'])->get('getLogin', [AuthController::class, 'getLogin']);

    Route::middleware(['auth', 'verified'])->get('/loginGlpi', [AuthController::class, 'loginToGLPI']);
//});

