<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedicalRecordsController;
use App\Http\Controllers\MedicinesController;
use App\Http\Controllers\RecipeDetailController;
use App\Http\Controllers\RegistrationOfficersController;
use App\Mail\MailHelper;
use App\Models\RegistrationOfficers;
use App\Http\Controllers\PattientController;
use App\Http\Controllers\RecordController;
use App\Services\MedicalRecordService;
use App\Services\PattientService;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\PolyclinicController;
use App\Http\Controllers\RecipeController;
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
Route::post("/lupa-sandi", [PattientController::class, "sendEmailVerivikasi"]);

// # Password Recovery
Route::get("/recovery/{token}", [PattientController::class, "checkTokenValid"]);
Route::post("/recovery/{token}", function (Request $request) {
    dd($request);
});
Route::post("/recovery/{token}", fn() => view("pacient.auth.recovery"));

// Dashboard
Route::prefix("/dashboard")->group(function () {
    // # Showing data consultation, history and setting
    Route::view("/", "pacient.dashboard.index")->middleware('pattientAuthenticate');
    // # Action pacient save setting
    Route::post("/save-setting", [PattientController::class, 'updateDataPattient'])->middleware('pattientAuthenticate');
    //changeEmail
    // # Action pacient change email
    Route::post("/change-email", [PattientController::class, 'changeEmail'])->middleware('pattientAuthenticate');

    // # Action pacient change password
    Route::post("/change-password", [PattientController::class, 'changePassword'])->middleware('pattientAuthenticate');
});

// Consultation
Route::prefix('konsultasi')->group(function () {

    // Create consultation #1 - description complaint & set category
    Route::get('/', [RecordCategoryController::class, 'index'])->middleware(['checkRecord', 'pattientAuthenticate']);
    Route::post(
        '/',
        function (Request $request) {
            session([
                'consultation' => [
                    "description" => trim($request->input("consultation_complaint")),
                    "category" => explode("-", $request->input("consultation_category")),
                ]
            ]);
            return redirect("/konsultasi/poliklinik");
        }
    )->middleware(['checkRecord', 'pattientAuthenticate']);

    // Create consultation #2 - set polyclinic
    Route::get(
        '/poliklinik',
        function () {
            if (!isset(session("consultation")["description"]))
                return redirect("/konsultasi");
            return view("pacient.consultation.polyclinic", [
                "polyclinics" => [
                    "PL0001" => "POLIKLINIK OBGYN (OBSTETRI & GINEKOLOGI)",
                    "PL0002" => "POLIKLINIK ANAK DAN TUMBUH KEMBANG",
                    "PL0003" => "POLIKLINIK PENYAKIT DALAM (INTERNA)",
                    "PL0004" => "POLIKLINIK BEDAH UMUM",
                    "PL0005" => "POLIKLINIK BEDAH ONKOLOGI"
                ]
            ]);
        }
    )->middleware('pattientAuthenticate');
    Route::post(
        '/poliklinik',
        function (Request $request) {
            session([
                'consultation' => array_merge(session('consultation'), [
                    "polyclinic" => explode("-", $request->input("consultation_polyclinic"))
                ])
            ]);
            return redirect("/konsultasi/dokter");
        }
    )->middleware(['checkRecord', 'pattientAuthenticate']);

    // Create consultation #3 - set doctor & schedule consultation
    Route::get(
        '/dokter',
        function () {
            if (!isset(session("consultation")["polyclinic"]))
                return redirect("/konsultasi/poliklinik");
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
        }
    )->middleware(['checkRecord', 'pattientAuthenticate']);
    Route::get(
        '/dokter/{id}',
        function ($id) {
            if (!isset(session("consultation")["polyclinic"]))
                return redirect("/konsultasi/poliklinik");
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
        }
    )->middleware(['checkRecord', 'pattientAuthenticate']);
    Route::get(
        '/dokter/{id}/{date}',
        function ($id, $date) {
            if (!isset(session("consultation")["polyclinic"]))
                return redirect("/konsultasi/poliklinik");
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
        }
    )->middleware(['checkRecord', 'pattientAuthenticate']);
    Route::post(
        '/dokter',
        function (Request $request) {
            session([
                'consultation' => array_merge(session('consultation'), [
                    "doctor" => explode("-", $request->input("consultation_doctor")),
                    "price" => $request->input("consultation_price"),
                    "schedule_date" => $request->input("consultation_schedule_date"),
                    "schedule_time" => explode("-", $request->input("consultation_schedule_time"))
                ])
            ]);
            return redirect("/konsultasi/rincian");
        }
    )->middleware(['checkRecord', 'pattientAuthenticate']);

    // Create consultation #4 - showing confirmation desciption data
    Route::get(
        '/rincian',
        function () {
            if (!isset(session("consultation")["doctor"]))
                return redirect("/konsultasi/dokter");
            return view("pacient.consultation.detail-order");
        }
    )->middleware(['checkRecord', 'pattientAuthenticate']);
    Route::post('/rincian', [RecordController::class, "store"]);

    // Show pacient consultation based on ID
    Route::get(
        '/{id}',
        [PattientController::class, 'showDataAction']
    );

    // Cancel sheduling consultation
    Route::get('/{id}/cancel-consultation', fn($id) => redirect("/konsultasi/{$id}"));
    Route::post('/{id}/cancel-consultation', [RecordController::class, 'cancelConsultation']);

    // Send proof payment to confirmation consultation
    Route::get('/{id}/payment-consultation', fn($id) => redirect("/konsultasi/{$id}"));
    Route::post('/{id}/payment-consultation', [RecordController::class, 'updateBukti']);


    // function (Request $request, $id) {
    //     // dd([
    //     //     "id" => $id,
    //     //     "state-payment" => $request->input("state-payment"),
    //     //     "bank-payment" => $request->input("bank-payment"),
    //     //     "upload-proof-payment" => $request->file('upload-proof-payment')
    //     // ]);
    // });

    // Cancel scheduling medical prescription
    Route::get('/{id}/cancel-medical-prescription', fn($id) => redirect("/konsultasi/{$id}"));
    Route::post(
        '/{id}/cancel-medical-prescription',
        function ($id) {
            dd($id);
        }
    );

    // Send proof payment to confirmation medical prescription
    Route::get('/{id}/payment-medical-prescription', fn($id) => redirect("/konsultasi/{$id}"));
    Route::post(
        '/{id}/payment-medical-prescription',
        function (Request $request, $id) {
            dd([
                "id" => $id,
                "state-payment" => $request->input("state-payment"),
                "bank-payment" => $request->input("bank-payment"),
                "upload-proof-payment" => $request->file('upload-proof-payment')
            ]);
        }
    );

    // Pacient generate consultation pickup document based on id
    Route::get(
        "/{id}/export",
        function ($id) {
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
        }
    );

    // Set option pickup delivery medical prescription
    Route::get('/{id}/pickup-delivery', fn($id) => redirect("/konsultasi/{$id}"));
    Route::post(
        '/{id}/pickup-delivery',
        function (Request $request, $id) {
            dd([
                "id" => $id,
                "pickup-medical-prescription" => $request->input('pickup-medical-prescription'),
                "pacient_notelp" => $request->input("pacient-notelp"),
                "pacient_address" => $request->input("pacient-addreass")
            ]);
        }
    );

    // Cancel pickup medical prescription
    Route::get('/{id}/cancel-pickup', fn($id) => redirect("/konsultasi/{$id}"));
    Route::post(
        '/{id}/cancel-pickup',
        function ($id) {
            dd([
                "id" => $id
            ]);
        }
    );
});


//admin
Route::prefix('admin')->group(
    function () {
        Route::view('/', 'admin.dashboard', )->middleware('isAdmin');

        Route::prefix('login')->group(
            function () {
                    Route::get(
                        '/',
                        function () {
                                        return view('admin.login');
                                    }
                    )->middleware('guestAdmin');
                    Route::post('login', [AdminController::class, 'login'])->middleware('guestAdmin');
                }
        );

        Route::prefix('pasien')->group(
            function () {
                    Route::view('view', 'admin.pasien')->middleware('isAdmin');
                    Route::get('/', [PattientController::class, 'index'])->middleware('isAdmin');
                    Route::post('store', [PattientController::class, 'storewithRekamMedic'])->middleware('isAdmin'); //redirect to /admin/pasien
                    Route::put(
                        'update',
                        [AdminController::class, 'updateDataPattient']
                    )->middleware('isAdmin');
                    Route::get('detail/{medical_record_id}', [PattientController::class, "findByIdInaAdmin"])->middleware('isAdmin');
                    Route::get(
                        'store',
                        function () {
                                        return view('admin.pasien-store');
                                    }
                    )->middleware('isAdmin');
                    Route::put(
                        'rs',
                        function (Request $request) {
                                        dd($request);
                                    }
                    )->middleware('isAdmin');
                }
        );

        Route::prefix('admin')->group(
            function () {
                    Route::get('/', [AdminController::class, 'index'])->middleware('isAdmin');
                    Route::post('store', [AdminController::class, 'store'])->middleware('isAdmin');
                    Route::put(
                        'update',
                        [AdminController::class, "updateAdmin"]
                    )->middleware('isAdmin');
                    Route::delete('destroy', [AdminController::class, 'destroy'])->middleware('isAdmin');
                }
        );

        Route::prefix('petugas')->group(
            function () {
                    Route::view('view', 'admin.petugas')->middleware('isAdmin');
                    Route::get('/')->middleware('isAdmin');
                    Route::post('store')->middleware('isAdmin');
                    Route::put('update')->middleware('isAdmin');
                    Route::delete('destroy')->middleware('isAdmin');
                }
        );


        Route::prefix('medrec')->group(
            function () {
                    Route::view('view', 'admin.medrec')->middleware('isAdmin');
                    Route::get('/')->middleware('isAdmin');
                    Route::post('store')->middleware('isAdmin');
                    Route::put('update')->middleware('isAdmin');
                    Route::delete('destroy')->middleware('isAdmin');
                }
        );

        Route::prefix('medicine')->group(
            function () {
                    Route::view('view', 'admin.medicine');
                    Route::get('/');
                    Route::post('store');
                    Route::put('update');
                    Route::delete('destroy');
                }
        );

        Route::prefix('category')->group(
            function () {
                    //category: nama kategori
                    //count: jumlah kategori digunakan pada komplain
                    Route::get(
                        '/',
                        [RecordCategoryController::class, 'indexAdmin']
                    )->middleware('isAdmin');
                    Route::post(
                        'store',
                        [RecordCategoryController::class, 'store']
                    )->middleware('isAdmin');
                    Route::put(
                        'update',
                        function (Request $request) {
                                        dd($request);
                                    }
                    )->middleware('isAdmin');
                    Route::delete(
                        'destroy',
                        [RecordCategoryController::class, 'destroy']
                    )->middleware('isAdmin');
                }
        );

        Route::prefix('schedule')->group(
            function () {
                    //category: nama kategori
                    //count: jumlah kategori digunakan pada komplain
                    Route::get(
                        '/',
                        function () {

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
                        }
                    )->middleware('isAdmin');
                    Route::post(
                        'store',
                        function (Request $request) {

                                        dd($request);
                                    }
                    )->middleware('isAdmin');
                    Route::put(
                        'update',
                        function (Request $request) {
                                        dd($request);
                                    }
                    )->middleware('isAdmin');
                    Route::delete(
                        'destroy',
                        function (Request $request) {
                                        dd([$request]);
                                    }
                    )->middleware('isAdmin');
                }
        );

        Route::prefix('complain')->group(
            function () {
                    Route::get(
                        '/',
                        [RecordController::class, 'showComplaintOnAdmin']
                    )->middleware('isAdmin');

                    Route::put(
                        'agreement',
                        [RecordController::class, 'confirmStatusPayment']
                    )->middleware('isAdmin');
                }
        );

        Route::prefix('consul')->group(
            function () {
                    Route::get(
                        '/',
                        [RecordController::class, 'showConsulOnAdmin']
                    );
                    //startCoverenceByAdmin
                    Route::get('vidcon/{id_consul}', [RecordController::class, "startCoverenceByAdmin"]);
                    Route::post('receipt/store', function (Request $request) {
                        /*
                        request = {
                        id_consule: id_consule
            , id_medicine: id_medicine
                        , qty: qty
                    }
                        */
                        $detailController = new RecipeDetailController();
                        $recipeController = new RecipeController();
                        $recipeController->checkRecipe();
                        $response = [
                            'id' => $request->id_medicine,
                            'name' => 'nama obat',
                            'qty' => $request->input('qty', 'qty kosong'),
                            'harga' => 'harga obat',
                            'total' => 'total dari qty dikali obat'
                        ];
                        echo json_encode($response);
                    })->name("receipt.store");
            
                    Route::delete('receipt/destroy', function (Request $request) {
                        //request {'id':'id obat yang akan dihapus dari resep'}
            
                        $response = [
                            'status' => 'success'
                        ];
            
                        echo json_encode($response);
                    })->name('receipt.destroy');

                }
        );

        //     return view('admin.consul', ['data' => $data]);
        // });

                //     echo json_encode($receipt);
                // }
        // )->name("getReceipt");
    
        Route::prefix('poly')->group(
            function () {
                Route::get(
                    '/',
                    function () {
                            // show data category on modal + polyclinic
                            $controller = new RecordCategoryController();
                            $category = $controller->showDataCategoryOnPolyclinic();
        
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
                        }
                );
                Route::post(
                    'store',
                    function (Request $request) {
                            dd($request);
                        }
                );
                Route::put(
                    'update',
                    function (Request $request) {
                            dd($request);
                        }
                );
        
                Route::delete(
                    'destroy',
                    function (Request $request) {
                            dd($request);
                        }
                );
            }
        );
        
    
    }

);



//dokter
Route::prefix('doctor')->group(function () {
    Route::prefix('/dashboard')->group(
        function () {
            Route::get(
                '/',
                function () {
                        return view('doctor.pages.dashboard');
                    }
            );
        }
    );

    Route::prefix('login')->group(
        function () {
            Route::get(
                '/',
                function () {
                        return view('doctor.pages.login');
                    }
            );

            Route::post(
                'login',
                function (Request $request) {
                        dd($request);
                    }
            );
        }
    );

    Route::get(
        '/consul',
        [RecordController::class, 'showConsulByDoctor']
    );

    Route::prefix('category')->group(
        function () {
            //category: nama kategori
            //count: jumlah kategori digunakan pada komplain
            Route::get(
                '/',
                function () {
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
                }
            );
            Route::post(
                '/store',
                function (Request $request) {
                        dd($request);
                    }
            );
            Route::put(
                '/update',
                function (Request $request) {
                        dd($request);
                    }
            );
            Route::delete(
                '/destroy',
                function (Request $request) {
                        dd([$request]);
                    }
            );
        }
    );

    Route::prefix('schedule')->group(
        function () {
            //category: nama kategori
            //count: jumlah kategori digunakan pada komplain
            Route::get(
                '/',
                function () {

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
                }
            );
        }
    );
});

// Logout ( Clear all session pacient )
Route::get("/keluar", [PattientController::class, 'logout']);