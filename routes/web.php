<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationOfficersController;
use App\Models\RegistrationOfficers;
use App\Http\Controllers\PattientController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//contoh middleware
// semua route dari controller admin controller akan di handle dengan middleware is admin
// Route::resource("/admin", AdminController::class)->middleware('isAdmin');
