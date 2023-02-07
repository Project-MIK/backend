<?php

use Illuminate\Http\Request;
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
            "schedule" => "1 / Januari / 2023 15:30:00 - 16:30:00",
            "status" => "waiting-consultation-payment",
            "valid_status" => 1675571753
        ],
        [
            "id" => "KL6584691",
            "description" => "Saya mengalami mual mual dan merasa selalu lemas setelah beberapa minggu ini hanya mengkonsumsi makanan mie......",
            "schedule" => "2 / Januari / 2023 15:30:00 - 16:30:00",
            "status" => "confirmed-consultation-payment",
            "valid_status" => 1685571753
        ],
        [
            "id" => "KL6584692",
            "description" => "Saya mengalami mual mual dan merasa selalu lemas setelah beberapa minggu ini hanya mengkonsumsi makanan mie......",
            "schedule" => "3 / Januari / 2023 15:30:00 - 16:30:00",
            "status" => "waiting-medical-prescription-payment",
            "valid_status" => 1675571753
        ],
        [
            "id" => "KL6584693",
            "description" => "Saya mengalami mual mual dan merasa selalu lemas setelah beberapa minggu ini hanya mengkonsumsi makanan mie......",
            "schedule" => "4 / Januari / 2023 15:30:00 - 16:30:00",
            "status" => "confirmed-medical-prescription-payment",
            "valid_status" => 1675571753
        ],
        [
            "id" => "KL6584694",
            "description" => "Saya mengalami mual mual dan merasa selalu lemas setelah beberapa minggu ini hanya dsdsdsdsds makanan mie......",
            "status" => "consultation-complete",
            "schedule" => "5 / Januari / 2023 15:30:00 - 16:30:00",
            "valid_status" => 1675571753
        ],
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

    Route::get('/{id}', function ($id) {
        return view("pacient.consultation.detail-consultation", [
            "id" => $id,
            "description" => "Saya mengalami mual mual dan merasa selalu lemas setelah beberapa minggu ini hanya dsdsdsdsds makanan mie......",
            "category" => "Penyakit Dalam",
            "polyclinic" => "POLIKLINIK PENYAKIT DALAM (INTERNA)",
            "doctor" => "Aristo Caesar Pratama",
            "schedule" => "8 / Februari / 2023 15:30:00 - 16:30:00",
            "status" => "consultation-complete",

            "price_consultation" => "Rp. 90.000",
            "status_payment_consultation" => "TERKONFIRMASI",
            "proof_payment_consultation" => "https://i.pinimg.com/236x/68/ed/dc/68eddcea02ceb29abde1b1c752fa29eb.jpg",

            "price_medical_prescription" => "Rp. 146.000",
            "status_payment_medical_prescription" => "TERKONFIRMASI",
            "proof_payment_medical_prescription" => "https://tangerangonline.id/wp-content/uploads/2021/06/IMG-20210531-WA0027.jpg",

            "pickup_medical_prescription" => "hospital-pharmacy", // hospital_pharmacy, delivery_gojek
            "pickup_medical_status" => null, // pending_pickup, complete_pickup, sending_by_gojek, be_deferred,
            "pickup_medical_description" => null, // alamat penerima tidak valid, pasien tidak dapat dihubungi 

            "valid_status" => "6 / Februari / 2023 03:00:00"
        ]);
    });

    Route::post('/{id}', function (Request $request, $id) {
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

// Logout

Route::redirect("/keluar", "/masuk");
