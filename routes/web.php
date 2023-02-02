<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


// - PACIENT

// Landing
Route::view("/", "pacient.index");

// Authentication
Route::view("/masuk", "pacient.auth.login");
Route::post("/masuk", fn () => view("pacient.auth.login"));

Route::view("/daftar", "pacient.auth.register");
Route::post("/daftar", fn () => view("pacient.auth.register"));

Route::view("/lupa-sandi", "pacient.auth.forgotPassword");
Route::post("/lupa-sandi", fn () => view("pacient.auth.forgotPassword"));

Route::get("/recovery/{token}", function ($token) {
    return view("pacient.auth.recovery");
});
Route::post("/recovery/{token}", fn () => view("pacient.auth.recovery"));

// Dashboard

Route::view("/dashboard", "pacient.dashboard.index", [
    "complaints" => [
        [
            "id" => "KL6584690",
            "description" => "Saya mengalami mual mual dan merasa selalu lemas setelah beberapa minggu ini hanya mengkonsumsi makanan mie......",
            "status" => "terkonfirmasi",
            "schedule" => "29 / Januari / 2023 15:30:00 - 16:30:00",
        ],
        [
            "id" => "KL6584690",
            "description" => "Saya mengalami mual mual dan merasa selalu lemas setelah beberapa minggu ini hanya mengkonsumsi makanan mie......",
            "status" => "terkonfirmasi",
            "schedule" => "29 / Januari / 2023 15:30:00 - 16:30:00",
        ]
    ]
]);

// Konsultasi
Route::prefix('konsultasi')->group(function () {
    Route::get('/', function () {
        echo "keluhan";
    });
    Route::get('/poliklinik', function () {
        echo "poliklinik";
    });
    Route::get('/dokter', function () {
        echo "dokter";
    });
    Route::get('/rincian', function () {
        echo "rincian";
    });
    Route::get('/pembayaran', function () {
        echo "pembayaran";
    });
});

Route::redirect("/keluar", "/masuk");
