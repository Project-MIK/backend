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

// Consultation

Route::prefix('konsultasi')->group(function () {
    Route::get('/', function () {
        return view("pacient.consultation.complaint");
    });
    Route::post('/', function () {
        return view("pacient.consultation.complaint");
    });

    Route::get('/poliklinik', function () {
        return view("pacient.consultation.polyclinic");
    });
    Route::post('/poliklinik', function () {
        return view("pacient.consultation.polyclinic");
    });

    Route::get('/dokter', function () {
        return view("pacient.consultation.doctor");
    });
    Route::post('/dokter', function () {
        return view("pacient.consultation.doctor");
    });

    Route::get('/rincian', function () {
        return view("pacient.consultation.detail");
    });
    Route::post('/rincian', function () {
        return view("pacient.consultation.detail");
    });

    Route::get('/pembayaran', function () {
        return view("pacient.consultation.payment");
    });
    Route::post('/pembayaran', function () {
        return view("pacient.consultation.payment");
    });

    Route::get('/{id}', function ($id) {
        return $id;
    });
});

// Logout

Route::redirect("/keluar", "/masuk");
