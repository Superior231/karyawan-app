<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes(['register' => false]);  // Register off

Route::get('/', [HomeController::class, 'index'])->name('home.index');
