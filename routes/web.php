<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationOfficersController;
use App\Models\RegistrationOfficers;
use App\Http\Controllers\PattientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


//contoh middleware
// semua route dari controller admin controller akan di handle dengan middleware is admin
// Route::resource("/admin", AdminController::class)->middleware('isAdmin');
Route::resource('/admin', AdminController::class);