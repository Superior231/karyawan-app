<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes(['register' => false]);  // Register off

// Admin
Route::middleware('auth')->group(function() {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::resource('position', PositionController::class);
    Route::resource('employee', EmployeeController::class);
    Route::resource('profile', ProfileController::class);
    Route::delete('/profile/{id}/delete-avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.delete.avatar');
});

// Super Admin
Route::prefix('superadmin')->middleware(['auth', 'isSuperAdmin'])->group(function() {
    Route::resource('admin', AdminController::class);
});
