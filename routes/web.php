<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified', 'role:admin'] )->group(function () {
    Route::get('/admin_dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
}); // group admin middleware

Route::middleware(['auth', 'verified', 'role:agent'] )->group(function () {
    Route::get('/agent_dashboard', [AgentController::class, 'dashboard'])->name('agent.dashboard');
}); // group agent middleware

Route::middleware(['auth', 'verified', 'role:user'] )->group(function () {
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
}); // group user middleware

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
