<?php

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

Route::controller(PolyclinicController::class)->group(function () {
    Route::get('/polyclinics', 'index');
    Route::get('/polyclinics/create', 'create');
    Route::post('/polyclinics', 'store');
    Route::get('/polyclinics/{id}', 'show');
    Route::get('/polyclinics/edit/{id}', 'edit');
    // Route::post('/polyclinics/update/{id}', 'update');
    Route::put('/polyclinics/{id}', 'update');
    // Route::post('/polyclinics/delete/{id}', 'destroy');
    Route::delete('/polyclinics/{id}', 'destroy');
});
