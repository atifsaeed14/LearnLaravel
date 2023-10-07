<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\ProjectController;

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

Route::controller(AuthController::class)->group(function () {
    Route::post('v1/login', 'login');
    Route::post('v1/register', 'register');
    // Route::post('v1/logout', 'logout');
});

Route::middleware('auth:sanctum')->get('v1/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('v1/tasks', TaskController::class)->only([
        'index', 'show', 'store', 'update', 'destroy',
    ]);

    Route::apiResource('v1/projects', ProjectController::class)->only([
        'index', 'show', 'store', 'update', 'destroy',
    ]);

    Route::apiResource('v1/posts', PostController::class)->except([
        'create', 'edit'
    ]);
});