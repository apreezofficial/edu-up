<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Admin\CourseController;

// admin routes with middleware protection
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Basic Dashboard route
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Sessions Management
    Route::resource('sessions', SessionController::class)->only(['index', 'create', 'store']);
    
    // Custom route for the "Set Current" action
    Route::post('sessions/{session}/set-current', [SessionController::class, 'setCurrent'])->name('sessions.set_current');

    // Course Management
    Route::resource('courses', CourseController::class)->only(['index', 'create', 'store']);
});