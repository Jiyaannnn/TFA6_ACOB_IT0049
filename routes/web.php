<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Each public URL is mapped to one controller action.
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
