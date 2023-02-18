<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PolyclinicController;
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

Route::get('/polyclinics', [PolyclinicController::class, 'index']);
Route::get('/polyclinics/{id}', [PolyclinicController::class, 'show']);
Route::get('/polyclinics/name/{name}', [PolyclinicController::class, 'searchByName']);

Route::get('/doctors', [DoctorController::class, 'index']);
Route::get('/doctors/{id}', [DoctorController::class, 'show']);
Route::get('/doctors/name/{name}', [DoctorController::class, 'searchByName']);
Route::get('/doctors/gender/{gender}', [DoctorController::class, 'searchByGender']);
