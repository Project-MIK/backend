<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedicalRecordsController;
use App\Http\Controllers\MedicinesController;
use App\Http\Controllers\RegistrationOfficersController;
use App\Mail\MailHelper;
use App\Models\RegistrationOfficers;
use App\Http\Controllers\PattientController;
use App\Http\Controllers\RecordController;
use App\Services\MedicalRecordService;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\PolyclinicController;
use App\Http\Controllers\RecordCategoryController;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;
use Svg\Tag\Rect;

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
Route::post("/masuk", [PattientController::class, "login"])->name('login');

// # Register
Route::view("/daftar", "pacient.auth.register")->middleware('pattentNotAuthenticate');
Route::post("/daftar", [PattientController::class, "store"]);

// # Forgot Password
Route::view("/lupa-sandi", "pacient.auth.forgot-password");
Route::post("/lupa-sandi", function (Request $request) {
    dd($request);
});

// # Password Recovery
Route::get("/recovery/{token}", function ($token) {
    return view("pacient.auth.recovery", compact("token"));
});
Route::post("/recovery/{token}", function (Request $request) {
    dd($request);
});
Route::post("/recovery/{token}", fn () => view("pacient.auth.recovery"));

// Dashboard
Route::prefix("/dashboard")->group(function () {
    // # Showing data consultation, history and setting
    Route::view("/", "pacient.dashboard.index");

    // # Action pacient save setting
    Route::post("/save-setting", function (Request $request) {
        dd($request);
    });

    // # Action pacient change email
    Route::post("/change-email", function (Request $request) {
        dd($request);
    });

    // # Action pacient change password
    Route::post("/change-password", function (Request $request) {
        dd($request);
    });
});

// Consultation
Route::prefix('konsultasi')->group(function () {
    // Create consultation #1 - description complaint & set category
    Route::get('/', function () {
        return view("pacient.consultation.complaint", [
            // Show categories type disease
            "categories" => [
                "K001" => "Penyakit Langka",
                "K002" => "Kelainan Bawaan",
                "K003" => "Gangguan Mental",
                "K004" => "Cedera",
                "K005" => "Penyakit Dalam",
                "K000" => "Tidak Tahu"
            ]
        ]);
    });
    Route::post('/', function (Request $request) {
        session(['consultation' => [
            "description" => trim($request->input("consultation_complaint")),
            "category" => explode("-", $request->input("consultation_category")),
        ]]);
        return redirect("/konsultasi/poliklinik");
    });

    // Create consultation #2 - set polyclinic
    Route::get('/poliklinik', function () {
        if (!isset(session("consultation")["description"])) return redirect("/konsultasi");
        return view("pacient.consultation.polyclinic", [
            "polyclinics" => [
                "PL0001" => "POLIKLINIK OBGYN (OBSTETRI & GINEKOLOGI)",
                "PL0002" => "POLIKLINIK ANAK DAN TUMBUH KEMBANG",
                "PL0003" => "POLIKLINIK PENYAKIT DALAM (INTERNA)",
                "PL0004" => "POLIKLINIK BEDAH UMUM",
                "PL0005" => "POLIKLINIK BEDAH ONKOLOGI"
            ]
        ]);
    });
    Route::post('/poliklinik', function (Request $request) {
        session(['consultation' => array_merge(session('consultation'), [
            "polyclinic" => explode("-", $request->input("consultation_polyclinic"))
        ])]);
        return redirect("/konsultasi/dokter");
    });

    // Create consultation #3 - set doctor & schedule consultation
    Route::get('/dokter', function () {
        if (!isset(session("consultation")["polyclinic"])) return redirect("/konsultasi/poliklinik");
        return view("pacient.consultation.doctor", [
            "doctors" => [
                [
                    "id" => 1,
                    "name" => "dr. IDA AYU SRI KUSUMA DEWI, M.Sc, Sp.A,MARS",
                ],
                [
                    "id" => 2,
                    "name" => "dr. PUTU VIVI PARYATI, M.Biomed, Sp.A",
                ],
                [
                    "id" => 3,
                    "name" => "dr. LUH GDE AYU PRAMITHA DEWI, M.Biomed, Sp.A",
                ],
            ],
            "detail_doctor" => [
                "price_consultation" => "Rp. 90.000",
                "date_schedule" => [
                    1676394000,
                    1676480400,
                    1676653199,
                ],
                "time_schedule" => [
                    [
                        "start" => 1676422800,
                        "end" => 1676426400
                    ],
                    [
                        "start" => 1676426400,
                        "end" => 1676430000
                    ],
                    [
                        "start" => 1676430000,
                        "end" => 1676433600
                    ]
                ]
            ]
        ]);
    });
    Route::get('/dokter/{id}', function ($id) {
        if (!isset(session("consultation")["polyclinic"])) return redirect("/konsultasi/poliklinik");
        return view("pacient.consultation.doctor", [
            "id" => $id,
            "doctors" => [
                [
                    "id" => 1,
                    "name" => "dr. IDA AYU SRI KUSUMA DEWI, M.Sc, Sp.A,MARS",
                ],
                [
                    "id" => 2,
                    "name" => "dr. PUTU VIVI PARYATI, M.Biomed, Sp.A",
                ],
                [
                    "id" => 3,
                    "name" => "dr. LUH GDE AYU PRAMITHA DEWI, M.Biomed, Sp.A",
                ],
            ],
            "detail_doctor" => [
                "price_consultation" => "Rp. 90.000",
                "date_schedule" => [
                    1677395000,
                    1677824000,
                    1677654199,
                ],
                "time_schedule" => [
                    [
                        "start" => 1676422800,
                        "end" => 1676426400
                    ],
                    [
                        "start" => 1676426400,
                        "end" => 1676430000
                    ],
                    [
                        "start" => 1676430000,
                        "end" => 1676433600
                    ]
                ]
            ]
        ]);
    });
    Route::get('/dokter/{id}/{date}', function ($id, $date) {
        if (!isset(session("consultation")["polyclinic"])) return redirect("/konsultasi/poliklinik");
        return view("pacient.consultation.doctor", [
            "id" => $id,
            "date" => $date,
            "doctors" => [
                [
                    "id" => 1,
                    "name" => "dr. IDA AYU SRI KUSUMA DEWI, M.Sc, Sp.A,MARS",
                ],
                [
                    "id" => 2,
                    "name" => "dr. PUTU VIVI PARYATI, M.Biomed, Sp.A",
                ],
                [
                    "id" => 3,
                    "name" => "dr. LUH GDE AYU PRAMITHA DEWI, M.Biomed, Sp.A",
                ],
            ],
            "detail_doctor" => [
                "price_consultation" => "Rp. 90.000",
                "date_schedule" => [
                    1677395000,
                    1677824000,
                    1677654199,
                ],
                "time_schedule" => [
                    [
                        "start" => 1676422800,
                        "end" => 1676426400
                    ],
                    [
                        "start" => 1676426400,
                        "end" => 1676430000
                    ],
                    [
                        "start" => 1676430000,
                        "end" => 1676433600
                    ]
                ]
            ]
        ]);
    });
    Route::post('/dokter', function (Request $request) {
        session(['consultation' => array_merge(session('consultation'), [
            "doctor" => explode("-", $request->input("consultation_doctor")),
            "price" => $request->input("consultation_price"),
            "schedule_date" => $request->input("consultation_schedule_date"),
            "schedule_time" => explode("-", $request->input("consultation_schedule_time"))
        ])]);
        return redirect("/konsultasi/rincian");
    });

    // Create consultation #4 - showing confirmation desciption data
    Route::get('/rincian', function () {
        if (!isset(session("consultation")["doctor"])) return redirect("/konsultasi/dokter");
        return view("pacient.consultation.detail-order");
    });
    Route::post('/rincian', function (Request $request) {
        // set data into database and remove session
        // dd($request);
        return redirect("/konsultasi/KL6584690#payment");
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
            "schedule" => 1677603600,
            "start_consultation" => 1677632400,
            "end_consultation" => 1677636000,
            "live_consultation" => false,
            "status" => "confirmed-medical-prescription-payment",

            "price_consultation" => "Rp. 90.000",
            "status_payment_consultation" => "TERKONFIRMASI", // PROSES VERIFIKASI / BELUM TERKONFIRMASI / TERKONFIRMASI / DIBATALKAN
            "proof_payment_consultation" => "https://i.pinimg.com/236x/68/ed/dc/68eddcea02ceb29abde1b1c752fa29eb.jpg",

            "price_medical_prescription" => "Rp. 100.000", // null
            "status_payment_medical_prescription" => "TERKONFIRMASI",
            "proof_payment_medical_prescription" => "https://tangerangonline.id/wp-content/uploads/2021/06/IMG-20210531-WA0027.jpg",

            "pickup_medical_prescription" => "hospital-pharmacy", // hospital-pharmacy, delivery-gojek
            "pickup_medical_status" => "MENUNGGU DIAMBIL", // MENUNGGU DIAMBIL, SUDAH DIAMBIL, DIKIRIM DENGAN GOJEK, GAGAL DIKIRIM, TIDAK MENERIMA SEKRANG
            "pickup_medical_no_telp_pacient" => "085235119101",
            "pickup_medical_addreass_pacient" => "Enim ullamco reprehenderit nulla aliqua reprehenderit",
            "pickup_medical_description" => "Alamat yang anda berikan tidak dapat dituju oleh driver GOJEK", // alamat penerima tidak valid, pasien tidak dapat dihubungi
            "pickup_by_pacient" => "Aristo Caesar Pratama",
            "pickup_datetime" => 1676184847,

            "valid_status" => 1677653043
        ]);
    });

    // Cancel sheduling consultation
    Route::get('/{id}/cancel-consultation', fn ($id) => redirect("/konsultasi/{$id}"));
    Route::post('/{id}/cancel-consultation', function ($id) {
        dd($id);
    });

    // Send proof payment to confirmation consultation
    Route::get('/{id}/payment-consultation', fn ($id) => redirect("/konsultasi/{$id}"));
    Route::post('/{id}/payment-consultation', function (Request $request, $id) {
        dd([
            "id" => $id,
            "state-payment" => $request->input("state-payment"),
            "bank-payment" => $request->input("bank-payment"),
            "upload-proof-payment" => $request->file('upload-proof-payment')
        ]);
    });

    // Cancel scheduling medical prescription
    Route::get('/{id}/cancel-medical-prescription', fn ($id) => redirect("/konsultasi/{$id}"));
    Route::post('/{id}/cancel-medical-prescription', function ($id) {
        dd($id);
    });

    // Send proof payment to confirmation medical prescription
    Route::get('/{id}/payment-medical-prescription', fn ($id) => redirect("/konsultasi/{$id}"));
    Route::post('/{id}/payment-medical-prescription', function (Request $request, $id) {
        dd([
            "id" => $id,
            "state-payment" => $request->input("state-payment"),
            "bank-payment" => $request->input("bank-payment"),
            "upload-proof-payment" => $request->file('upload-proof-payment')
        ]);
    });

    // Pacient generate consultation pickup document based on id
    Route::get("/{id}/export", function ($id) {
        $document = [
            "fullname" => "Aristo Caesar Pratama",
            "no_medical_record" => "00-89-43-78-34-56",
            "id_consultation" => "KL6584691",
            "valid_status" => 1676134847,
            "consultation" => [
                "doctor" => "DR. H. M. Pilox Kamacho H., S.pb",
                "price" => "Rp. 90.000",
                "status" => "TERKOFIRMASI",
            ],
            "medical" => [
                "price" => "Rp. 90.000",
                "status" => "TERKOFIRMASI",
            ]
        ];

        $pdf = PDF::loadView("pacient.consultation.pdf.consultation_pickup", compact("document"));
        return $pdf->download("DOKUMEN PENGAMBILAN OBAT - {$id}.pdf");
    });

    // Set option pickup delivery medical prescription
    Route::get('/{id}/pickup-delivery', fn ($id) => redirect("/konsultasi/{$id}"));
    Route::post('/{id}/pickup-delivery', function (Request $request, $id) {
        dd([
            "id" => $id,
            "pickup-medical-prescription" => $request->input('pickup-medical-prescription'),
            "pacient_notelp" => $request->input("pacient-notelp"),
            "pacient_address" => $request->input("pacient-addreass")
        ]);
    });

    // Cancel pickup medical prescription
    Route::get('/{id}/cancel-pickup', fn ($id) => redirect("/konsultasi/{$id}"));
    Route::post('/{id}/cancel-pickup', function ($id) {
        dd([
            "id" => $id
        ]);
    });
});


//admin
Route::prefix('admin')->group(function () {
    Route::view('/', 'admin.dashboard',);

    Route::prefix('login')->group(function () {
        Route::get('/', function () {
            return view('admin.login');
        });

        Route::post('login', function (Request $request) {
            dd($request);
        });
    });

    Route::prefix('pasien')->group(function () {
        Route::view('view', 'admin.pasien');
        Route::get('/', [PattientController::class, 'index']);
        Route::post('store', [PattientController::class, 'storewithRekamMedic']); //redirect to /admin/pasien
        Route::put('update', function (Request $request) {

            dd($request);
        });
        Route::get('detail/{medical_record_id}', function ($medical_record_id) {
            //butuh fungsi getbyId
            $data = [
                'fullname' => "Bachtiar", //
                'email' => "bachtiarah@gmail.com", //
                'gender' => "L", //
                'password' => "Asa", //
                'phone_number' => "082234439795", //
                'address_RT' => "01", //
                'address_RW' => "01", //
                'address_desa' => "Banjarejo", //
                'address_dusun' => "Banjarejo", //
                'address_kecamatan' => "Dagangan", //
                'address_kabupaten' => "Madiun", //
                'citizen' => "WNA", //
                'profession' => "Mahasiswa", //
                'date_birth' => "18 Januari 2003", //
                'blood_group' => "-", //
                'place_birth' => "Madiun", //
                'no_paspor' => "1234567890123456", //
                "medical_record_id" => "123456",
                "id_registration_officer" => "1",
            ];
            return view('admin.pasien-detail', ["data" => $data]);
        });
        Route::get('store', function () {
            return view('admin.pasien-store');
        });
        Route::put('rs', function (Request $request) {
            dd($request);
        });
    });

    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index']);
        Route::post('store', [AdminController::class, 'store']);
        Route::put('update');
        Route::delete('destroy', [AdminController::class, 'destroy']);
    });

    Route::prefix('petugas')->group(function () {
        Route::view('view', 'admin.petugas');
        Route::get('/');
        Route::post('store');
        Route::put('update');
        Route::delete('destroy');
    });

    Route::prefix('doctor')->group(function () {
        Route::view('view', 'admin.doctor');
        Route::get('/');
        Route::post('store');
        Route::put('update');
        Route::delete('destroy');
    });

    Route::prefix('medrec')->group(function () {
        Route::view('view', 'admin.medrec');
        Route::get('/');
        Route::post('store');
        Route::put('update');
        Route::delete('destroy');
    });

    Route::prefix('medicine')->group(function () {
        Route::view('view', 'admin.medicine');
        Route::get('/');
        Route::post('store',function(Request $request){
            dd($request);
        });
        Route::put('update');
        Route::delete('destroy');
    });

    Route::prefix('category')->group(function () {
        //category: nama kategori
        //count: jumlah kategori digunakan pada komplain
        Route::get('/', function () {
            $poli = [
                ['id_poly' => '1', 'poly' => 'anak'],
                ['id_poly' => '2', 'poly' => 'dalam']
            ];

            $data = [
                'data' => [
                    ['id_category' => '1', 'category' => 'kepala', 'count' => 12, 'id_poly' => '1', 'poly' => 'anak'],
                    ['id_category' => '2', 'category' => 'perut', 'count' => 12, 'id_poly' => '2', 'count' => 5, 'poly' => 'dalam'],
                    ['id_category' => '3', 'category' => 'tangan', 'count' => 12, 'id_poly' => '1', 'count' => 0, 'poly' => 'anak']
                ],
                'poly' => $poli
            ];
            return view('admin.category', $data);
        });
        Route::post('store', function (Request $request) {
            dd($request);
        });
        Route::put('update', function (Request $request) {
            dd($request);
        });
        Route::delete('destroy', function (Request $request) {
            dd([$request]);
        });
    });

    Route::prefix('schedule')->group(function () {
        //category: nama kategori
        //count: jumlah kategori digunakan pada komplain
        Route::get('/', function () {

            $data = [
                [
                    'id' => '10',
                    'date' => '1677373423',
                    'start' => '1677373423',
                    'end' => '1675386223'
                ],
                [
                    'id' => '2',
                    'date' => '1677373423',
                    'start' => '1677373423',
                    'end' => '1675386223'
                ],
            ];
            return view('admin.schedule', ['data' => $data]);
        });
        Route::post('store', function (Request $request) {

            dd($request);
        });
        Route::put('update', function (Request $request) {
            dd($request);
        });
        Route::delete('destroy', function (Request $request) {
            dd([$request]);
        });
    });

    Route::prefix('complain')->group(function () {

        Route::get('/', function () {
            $data = [
                [
                    'id' => 'KLaasdj',
                    'name' => 'Bachtiar Arya Habibie',
                    'category' => 'kepala',
                    'poly' => 'anak',
                    'doctor' => 'anis',
                    'link_foto' => 'https://blue.kumparan.com/image/upload/fl_progressive,fl_lossy,c_fill,q_auto:best,w_640/v1600959891/inewyddubc2v9au1ef2h.png',
                    'description' => 'Saya, John, mengalami sakit kepala yang cukup mengganggu belakangan ini. Sakit kepala ini terjadi pada bagian belakang kepala dan terjadi sekitar 2-3 kali seminggu. Setiap kali sakit kepala terjadi, saya merasakan mual dan sedikit pusing yang cukup mengganggu aktivitas saya. Sakit kepala ini berlangsung selama sekitar 2-3 jam setiap kali terjadi. Meskipun saya tidak memiliki riwayat penyakit kepala atau keluarga yang menderita sakit kepala secara serius, namun saya menyadari bahwa kebiasaan saya yang sering bekerja dengan komputer dalam waktu yang lama dan kurang istirahat mungkin menjadi faktor pemicu sakit kepala yang saya alami. Saya berharap dapat menemukan solusi yang tepat untuk mengatasi keluhan sakit kepala yang saya alami ini.',
                    'payment_method' => 'BRI',
                    'payment_amount' => 90000,
                    'status' => 0
                ],
                [
                    'id' => 'KLqwer',
                    'name' => 'Muhammad Tajut Zamzami',
                    'category' => 'paru-paru',
                    'poly' => 'dalam',
                    'doctor' => 'Andre',
                    'link_foto' => 'https://images.tokopedia.net/img/cache/500-square/hDjmkQ/2022/2/21/ba348df9-d8a5-459a-9cb9-acc30dc45eda.jpg',
                    'description' => 'Saya merasakan sesak napas yang cukup parah dan sulit untuk bernafas dengan normal. Saya juga merasakan adanya rasa nyeri atau ketidaknyamanan pada dada saya saat bernapas atau batuk. Terkadang, saya juga merasa sangat lelah dan tidak bertenaga akibat kekurangan oksigen dalam tubuh. Rasanya sangat tidak nyaman dan membuat saya sulit untuk melakukan aktivitas sehari-hari dengan baik. Saya berharap agar cepat pulih dari kondisi ini dan kembali dapat menjalani hidup dengan normal kembali.',
                    'payment_method' => 'BRI',
                    'payment_amount' => 90000,
                    'status' => 1
                ],
                [
                    'id' => 'KLqweas',
                    'name' => 'Muhammad Tajut Zamzami',
                    'category' => 'paru-paru',
                    'poly' => 'dalam',
                    'doctor' => 'Andre',
                    'link_foto' => 'https://images.tokopedia.net/img/cache/500-square/hDjmkQ/2022/2/21/ba348df9-d8a5-459a-9cb9-acc30dc45eda.jpg',
                    'description' => 'Saya merasakan sesak napas yang cukup parah dan sulit untuk bernafas dengan normal. Saya juga merasakan adanya rasa nyeri atau ketidaknyamanan pada dada saya saat bernapas atau batuk. Terkadang, saya juga merasa sangat lelah dan tidak bertenaga akibat kekurangan oksigen dalam tubuh. Rasanya sangat tidak nyaman dan membuat saya sulit untuk melakukan aktivitas sehari-hari dengan baik. Saya berharap agar cepat pulih dari kondisi ini dan kembali dapat menjalani hidup dengan normal kembali.',
                    'payment_method' => 'BRI',
                    'payment_amount' => 90000,
                    'status' => 2
                ],
            ];
            return view('admin.complain', ['data' => $data]);
        });

        Route::put('agreement', function (Request $request) {
            dd($request);
        });
    });

    Route::prefix('consul')->group(function () {
        Route::get('/', function () {
            $data = [
                [
                    'consul_id' => 'KL4567',
                    'patient_name' => 'tajut zamzami', // name of patient who need consultation
                    'medrec' => '123456', //medical record of patient
                    'doctor' => 'Dr. Anis',
                    'duration' => 3600, //the video duration of video conference in milisecond
                    'start' => '1677639600', //the jitsi meet start in timestamp
                    'end' => '1677643200', //the jitsi meet end in timestamp
                    'link' => 'https://meet.jit.si/KL4567' //the jitsi meeting link 
                ],
                [
                    'consul_id' => 'KL123',
                    'patient_name' => 'Bachtiar Arya', // name of patient who need consultation
                    'medrec' => '654321', //medical record of patient
                    'doctor' => 'Dr. Andre',
                    'duration' => 3600, //the video duration of video conference in milisecond
                    'start' => '1677650400', //the jitsi meet start in timestamp
                    'end' => '1677654000', //the jitsi meet end in timestamp
                    'link' => 'https://meet.jit.si/KL123' //the jitsi meeting link 
                ]
            ];

            return view('admin.consul', ['data' => $data]);
        });

        Route::get('vidcon/{id_consul}', function ($id_consul) {

            //data from getById($id_consul) 
            $data = [
                'id_consul' => $id_consul, 
                'doctor' => 'Dr. Anis', 
                'patien' => 'Bachtiar',
                'duration' => 7200000 //in milisecond
            ];
            return view('admin.jitsi', ['data' => $data]);
        });

        Route::post('receipt/store',function(Request $request){
            dd($request);
        });

    });

    Route::prefix('poly')->group(function () {


        Route::get('/', function () {
            $category = [
                [
                    'id_category' => '1',
                    'category' => 'kategory 1'
                ],
                [
                    'id_category' => '2',
                    'category' => 'kategory 2'
                ],
                [
                    'id_category' => '3',
                    'category' => 'kategory 3'
                ],
            ];

            $data = [
                [
                    'id_poly' => '1',
                    'poly' => 'anak',
                    'id_category' => '1',
                    'category' => 'kategori 1'
                ],
                [
                    'id_poly' => '12',
                    'poly' => 'dalam',
                    'id_category' => '1',
                    'category' => 'kategori 1'
                ],
                [
                    'id_poly' => '13',
                    'poly' => 'dalam',
                    'id_category' => '2',
                    'category' => 'kategori 2'
                ],
            ];
            return view('admin.poli', ['data' => $data, 'category' => $category]);
        });

        Route::post('store', function (Request $request) {
            dd($request);
        });

        Route::put('update', function (Request $request) {
            dd($request);
        });

        Route::delete('destroy', function (Request $request) {
            dd($request);
        });
    });
});

//dokter
Route::prefix('doctor')->group(function () {
    Route::prefix('/dashboard')->group(function () {
        Route::get('/', function () {
            return view('doctor.pages.dashboard');
        });
    });

    Route::prefix('login')->group(function () {
        Route::get('/', function () {
            return view('doctor.pages.login');
        });

        Route::post('login', function (Request $request) {
            dd($request);
        });
    });

    Route::get('/consul', function () {
        $data = [
            [
                'consul_id' => 'KL4567',
                'patient_name' => 'tajut zamzami', // name of patient who need consultation
                'medrec' => '123456', //medical record of patient
                'duration' => 3600, //the video duration of video conference in milisecond
                'start' => '1677639600', //the jitsi meet start in timestamp
                'end' => '1677643200', //the jitsi meet end in timestamp
                'link' => 'https://meet.jit.si/KL4567' //the jitsi meeting link 
            ],
            [
                'consul_id' => 'KL123',
                'patient_name' => 'Bachtiar Arya', // name of patient who need consultation
                'medrec' => '654321', //medical record of patient
                'duration' => 3600, //the video duration of video conference in milisecond
                'start' => '1677650400', //the jitsi meet start in timestamp
                'end' => '1677654000', //the jitsi meet end in timestamp
                'link' => 'https://meet.jit.si/KL123' //the jitsi meeting link 
            ]
        ];

        return view('doctor.pages.consul', ['data' => $data]);
    });

    Route::prefix('category')->group(function () {
        //category: nama kategori
        //count: jumlah kategori digunakan pada komplain
        Route::get('/', function () {
            $poli = [
                ['id_poly' => '1', 'poly' => 'anak'],
                ['id_poly' => '2', 'poly' => 'dalam']
            ];

            $data = [
                'data' => [
                    ['id_category' => '1', 'category' => 'kepala', 'count' => 12, 'id_poly' => '1', 'poly' => 'anak'],
                    ['id_category' => '2', 'category' => 'perut', 'count' => 12, 'id_poly' => '2', 'count' => 5, 'poly' => 'dalam'],
                    ['id_category' => '3', 'category' => 'tangan', 'count' => 12, 'id_poly' => '1', 'count' => 0, 'poly' => 'anak']
                ],
                'poly' => $poli
            ];
            return view('doctor.pages.category', $data);
        });
        Route::post('/store', function (Request $request) {
            dd($request);
        });
        Route::put('/update', function (Request $request) {
            dd($request);
        });
        Route::delete('/destroy', function (Request $request) {
            dd([$request]);
        });
    });

    Route::prefix('schedule')->group(function () {
        //category: nama kategori
        //count: jumlah kategori digunakan pada komplain
        Route::get('/', function () {

            $data = [
                [
                    'id' => '1',
                    'date' => '1677373423',
                    'start' => '1677373423',
                    'end' => '1675386223'
                ],
                [
                    'id' => '2',
                    'date' => '1677373423',
                    'start' => '1677373423',
                    'end' => '1675386223'
                ],
            ];
            return view('doctor.pages.schedule', ['data' => $data]);
        });
    });
});

// Logout ( Clear all session pacient )
Route::get("/keluar", function () {
    return redirect('/masuk');
});
