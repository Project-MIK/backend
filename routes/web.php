<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedicalRecordsController;
use App\Http\Controllers\MedicinesController;
use App\Http\Controllers\RegistrationOfficersController;
use App\Mail\MailHelper;
use App\Models\RegistrationOfficers;
use App\Http\Controllers\PattientController;
use App\Http\Controllers\RecordController;
use App\Services\MedicalRecordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\PolyclinicController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


// - PACIENT

// Landing
Route::view("/", "pacient.index");

// Authentication - Login
Route::view("/masuk", "pacient.auth.login")->middleware('pattentNotAuthenticate');
Route::post("/masuk", [PattientController::class , "login"])->name('login');

// Authentication - Register
Route::view("/daftar", "pacient.auth.register");
Route::post("/daftar", [PattientController::class, "store"]);

// Authentication - Forgot Password
Route::view("/lupa-sandi", "pacient.auth.forgotPassword");
Route::post("/lupa-sandi", function (Request $request) {
    dd($request);
});

// Authentication - Password Recovery
Route::get("/recovery/{token}", function ($token) {
    return view("pacient.auth.recovery", compact("token"));
});
Route::post("/recovery/{token}", function (Request $request, $token) {
    dd($token);
    dd($request);
});

// Dashboard

Route::view("/dashboard", "pacient.dashboard.index", [
    // show complaint not equlas consultation-complete && valid status
    "complaints" => [
        [
            "id" => "KL6584690",
            "description" => "Consectetur veniam excepteur est ea consequat adipisicing sunt mollit. Mollit in quis ipsum fugiat officia ea est nostrud id cupidatat voluptate adipisicing. Est veniam ullamco velit consequat cupidatat ea ad tempor sunt et do qui pariatur proident.",
            "schedule" => "1 / Januari / 2023",
            "start_consultation" => 1685571753,
            "end_consultation" => 1685572753,
            "status" => "confirmed-consultation-payment", // waiting-consultation-payment, confirmed-consultation-payment , waiting-medical-prescription-payment , confirmed-medical-prescription-payment, consultation-complete
            "valid_status" => 1685571753
        ]
    ],
    // show complaint consultation-complete, expired && not valid status
    "history_complaints" => [
        [
            "id" => "KL6584690",
            "description" => "Consectetur veniam excepteur est ea consequat adipisicing sunt mollit. Mollit in quis ipsum fugiat officia ea est nostrud id cupidatat voluptate adipisicing. Est veniam ullamco velit consequat cupidatat ea ad tempor sunt et do qui pariatur proident.",
            "schedule" => "1 / Januari / 2023",
            "start_consultation" => 1685571753,
            "end_consultation" => 1685572753,
            "status" => "confirmed-consultation-payment",
            "valid_status" => 1685571753
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
        return view("pacient.consultation.detail-order");
    });
    Route::post('/rincian', function () {
        return view("pacient.consultation.detail-order");
    });

    Route::get('/pembayaran', function () {
        return view("pacient.consultation.payment");
    });
    Route::post('/pembayaran', function () {
        return view("pacient.consultation.payment");
    });

    // Show pacient consultation based on ID
    Route::get('/{id}', function ($id) {
        return view("pacient.consultation.detail-consultation", [
            "id" => $id,
            "name_pacient" => "Aristo Caesar Pratama",
            "description" => "Saya mengalami mual mual dan merasa selalu lemas setelah beberapa minggu ini hanya dsdsdsdsds makanan mie......",
            "category" => "Penyakit Dalam",
            "polyclinic" => "POLIKLINIK PENYAKIT DALAM (INTERNA)",
            "doctor" => "DR. H. M. Pilox Kamacho H., S.pb",
            "schedule" => "8 / Februari / 2023",
            "start_consultation" => 1675924610,
            "end_consultation" => 1675926110,
            "live_consultation" => true,
            "status" => "consultation-complete",

            "price_consultation" => "Rp. 90.000",
            "status_payment_consultation" => "TERKONFIRMASI",
            "proof_payment_consultation" => "https://i.pinimg.com/236x/68/ed/dc/68eddcea02ceb29abde1b1c752fa29eb.jpg",

            "price_medical_prescription" => "Rp. 100.000", // null
            "status_payment_medical_prescription" => "TERKONFIRMASI",
            "proof_payment_medical_prescription" => "https://tangerangonline.id/wp-content/uploads/2021/06/IMG-20210531-WA0027.jpg",

            "pickup_medical_prescription" => "hospital-pharmacy", // hospital-pharmacy, delivery-gojek
            "pickup_medical_status" => "SUDAH DIAMBIL", // MENUNGGU DIAMBIL, SUDAH DIAMBIL, DIKIRIM DENGAN GOJEK, GAGAL DIKIRIM,
            "pickup_medical_no_telp_pacient" => "085235119101",
            "pickup_medical_addreass_pacient" => "Enim ullamco reprehenderit nulla aliqua reprehenderit",
            "pickup_medical_description" => "Alamat yang anda berikan tidak dapat dituju oleh driver GOJEK", // alamat penerima tidak valid, pasien tidak dapat dihubungi
            "pickup_by_pacient" => "Aristo Caesar Pratama",
            "pickup_datetime" => "7 Februari 2023 - 15:43:77",

            "valid_status" => "6 / Februari / 2023 03:00:00"
        ]);
    });

    Route::post('/{id}/cancel-consultation', function () {
        // cancel consultation
    });

    Route::post('/{id}/payment-consultation', function (Request $request, $id) {
        dd([
            "id" => $id,
            "state-payment" => $request->input("state-payment"),
            "bank-payment" => $request->input("bank-payment"),
            "upload-proof-payment" => $request->file('upload-proof-payment')
        ]);
    });

    Route::post('/{id}/cancel-medical-prescription', function () {
        // cancel medical prescription
    });

    Route::post('/{id}/payment-medical-prescription', function (Request $request, $id) {
        dd([
            "id" => $id,
            "state-payment" => $request->input("state-payment"),
            "bank-payment" => $request->input("bank-payment"),
            "upload-proof-payment" => $request->file('upload-proof-payment')
        ]);
    });

    Route::post('/{id}/pickup-delivery', function (Request $request, $id) {
        dd([
            "id" => $id,
            "pickup-medical-prescription" => $request->input('pickup-medical-prescription'),
            "pacient_notelp" => $request->input("pacient-notelp"),
            "pacient_address" => $request->input("pacient-addreass")
        ]);
    });

    Route::post('/{id}/cancel-pickup', function ($id) {
        dd([
            "id" => $id
        ]);
    });
});

//contoh middleware
// semua route dari controller admin controller akan di handle dengan middleware is admin
// Route::resource("/admin", AdminController::class)->middleware('isAdmin');

// Logout

Route::redirect("/keluar", "/masuk");
