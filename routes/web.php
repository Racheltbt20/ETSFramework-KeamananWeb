<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'nocache'])->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('students.index');
    Route::resource('students', StudentController::class)->except(['index', 'show']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});

// Route::get('/test-error', function () {
//     throw new \Exception('Tes error 500');
// });