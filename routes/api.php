<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TaskController;

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

Route::get('v1/tasks', [TaskController::class, 'index']);

Route::resource('v1/post', PostController::class);
// Route::post('register', [AuthController::class, 'register']);
// Route::post('login', [AuthController::class, 'login']);

// Route::group(['middleware' => ['auth:api']], function () {
//     Route::post('logout', [AuthController::class, 'logout']);
// });

// Route::controller(AuthController::class)->group(function () {
//     Route::post('v1/login', 'login');
//     Route::post('v1/register', 'register');
//     Route::post('v1/logout', 'logout');
// });

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::apiResource('v1/post', PostController::class)->except([
//     'create', 'show', 'edit'
// ]);

// Route::apiResource('v1/post', PostController::class)->only([
//     'index', 'show'
// ]);