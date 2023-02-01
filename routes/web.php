<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing
Route::view("/", "pacient.index");

// Authentication
Route::get("/masuk", fn () => view("pacient.auth.login"));
