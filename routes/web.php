<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationOfficersController;
use App\Models\RegistrationOfficers;
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

Route::resource("login", LoginController::class);

Route::controller(RegistrationOfficersController::class)->middleware("guest")->group(function () {
    Route::get("/officers" , "index")->name('index');
    Route::get("/officers/create", "create")->name('create');
    Route::post("/officers", "store")->name('store');
    Route::get("/officers/{id}/edit", "show")->name('show');
    Route::put("/officers/{id}", "update")->name('update');
    Route::delete("/officers/{id}" , "destroy")->name('destroy');
    Route::get('/officers/{id}', "show")->name('show');
});

