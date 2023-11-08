<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;

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
//    Route::post('v1/changePassword', 'changePassword');
//    Route::post('v1/profileStore', 'profileStore');
//    Route::post('v1/updatePassword', 'updatePassword');
});

Route::middleware('auth:sanctum')->get('v1/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::put('v1/password', [AuthController::class, 'updatePassword'])->name('password.updatePassword');
    Route::get('v1/profile/{profile}', [ProfileController::class, 'showApi'])->name('profile.showApi');
    Route::put('v1/profile/{profile}', [ProfileController::class, 'updateApi'])->name('profile.updateApi');
    Route::get('v1/profile', [ProfileController::class, 'indexApi'])->name('profile.indexApi');


    
    Route::apiResource('v1/tasks', TaskController::class)->only([
        'index', 'show', 'store', 'update', 'destroy',
    ]);

    Route::apiResource('v1/projects', ProjectController::class)->only([
        'index', 'show', 'store', 'update', 'destroy',
    ]);

    Route::apiResource('v1/posts', PostController::class)->except([
        'create', 'edit'
    ]);

    /*Route::apiResource('products', ProductController::class)->only([
        'index', 'show', 'store', 'update', 'destroy',
    ]);*/
    Route::apiResource('products', ProductController::class);
    Route::apiResource('stores', StoreController::class);    
    
});


