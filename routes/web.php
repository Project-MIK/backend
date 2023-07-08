<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthDoctorController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorScheduleController;
use App\Http\Controllers\DoctorSettingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedicalRecordsController;
use App\Http\Controllers\MedicinesController;
use App\Http\Controllers\RecipeDetailController;
use App\Http\Controllers\RegistrationOfficersController;
use App\Http\Controllers\ScheduleDetailController;
use App\Mail\MailHelper;
use App\Models\RegistrationOfficers;
use App\Http\Controllers\PattientController;
use App\Http\Controllers\RecordController;
use App\Services\MedicalRecordService;
use App\Services\PattientService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\PolyclinicController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RecordCategoryController;
use App\Models\Doctor;
use App\Services\MedicineService;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;
use Svg\Tag\Rect;
use App\Http\Controllers\ConsultationController;
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
Route::post("/recovery/{token}", [PattientController::class, 'forgot_pasword']);

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
    Route::get('/poliklinik', [ConsultationController::class, 'polyclinic']);
    Route::post('/poliklinik', [ConsultationController::class, 'storePolyclinic']);

    // Route::get('/poliklinik', function () {
    //     if (!isset(session("consultation")["description"])) return redirect("/konsultasi");
    //     return view("pacient.consultation.polyclinic", [
    //         "polyclinics" => [
    //             "PL0001" => "POLIKLINIK OBGYN (OBSTETRI & GINEKOLOGI)",
    //             "PL0002" => "POLIKLINIK ANAK DAN TUMBUH KEMBANG",
    //             "PL0003" => "POLIKLINIK PENYAKIT DALAM (INTERNA)",
    //             "PL0004" => "POLIKLINIK BEDAH UMUM",
    //             "PL0005" => "POLIKLINIK BEDAH ONKOLOGI"
    //         ]
    //     ]);
    // });


    // Create consultation #3 - set doctor & schedule consultation
    Route::get('/dokter', [ConsultationController::class, 'doctor']);
    Route::post('/dokter', [ConsultationController::class, 'storeDoctor']);
    Route::get('/dokter/{id}', [ConsultationController::class, 'showDoctor']);
    Route::get('/dokter/{id}/{date}', [ConsultationController::class, 'showDateDoctor']);

    // Create consultation #4 - showing confirmation desciption data
    Route::get('/rincian', [ConsultationController::class, 'consultation']);
    Route::post('/rincian', [ConsultationController::class, 'storeConsultation']);

    // Show pacient consultation based on ID
    Route::get(
        '/{id}',
        [PattientController::class, 'showDataAction']
    );

    // Cancel sheduling consultation
    Route::get('/{id}/cancel-consultation', fn ($id) => redirect("/konsultasi/{$id}"));
    Route::post('/{id}/cancel-consultation', [RecordController::class, 'cancelConsultation']);

    // Send proof payment to confirmation consultation
    Route::get('/{id}/payment-consultation', fn ($id) => redirect("/konsultasi/{$id}"));
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
    Route::get('/{id}/cancel-medical-prescription', fn ($id) => redirect("/konsultasi/{$id}"));
    Route::post('/{id}/cancel-medical-prescription', [RecordController::class, "cancelMedicalPrescription"]);

    // Send proof payment to confirmation medical prescription
    Route::get('/{id}/payment-medical-prescription', fn ($id) => redirect("/konsultasi/{$id}"));
    Route::post(
        '/{id}/payment-medical-prescription',
        [RecipeController::class, 'updateBuktiPembayaran']
    );

    // Pacient generate consultation pickup document based on id
    Route::get(
        "/{id}/export",
        function ($id) {
            // $document = [
            //     "fullname" => "Aristo Caesar Pratama",
            //     "no_medical_record" => "00-89-43-78-34-56",
            //     "id_consultation" => "KL6584691",
            //     "valid_status" => 1676134847,
            //     "consultation" => [
            //         "doctor" => "DR. H. M. Pilox Kamacho H., S.pb",
            //         "price" => "Rp. 90.000",
            //         "status" => "TERKOFIRMASI",
            //     ],
            //     "medical" => [
            //         "price" => "Rp. 90.000",
            //         "status" => "TERKOFIRMASI",
            //     ]
            // ];
            $controller = new RecordController();
            $document = $controller->cetakDocument($id)[0];

            $pdf = Pdf::loadView("pacient.consultation.pdf.consultation_pickup", compact("document"));
            return $pdf->download("DOKUMEN PENGAMBILAN OBAT - {$id}.pdf");
        }
    );

    // Set option pickup delivery medical prescription
    Route::get('/{id}/pickup-delivery', fn ($id) => redirect("/konsultasi/{$id}"));
    Route::post(
        '/{id}/pickup-delivery',
        [RecordController::class, 'setMetodeDelivery']
    );

    // Cancel pickup medical prescription
    Route::get('/{id}/cancel-pickup', fn ($id) => redirect("/konsultasi/{$id}"));
    Route::post('/{id}/cancel-pickup', function ($id) {
        dd([
            "id" => $id
        ]);
    });
});


//admin
Route::prefix('admin')->group(
    function () {
        Route::redirect('/', '/admin/consul');
        // Route::view('/', 'admin.dashboard',)->middleware('isAdmin');

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

        Route::prefix('logout')->group(
            function () {
                Route::get(
                    '/',
                    [AdminController::class, "logout"]
                );
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
                    [PattientController::class, "kirimRekamMedic"]
                )->middleware('isAdmin');
                Route::get('cetak/{id}',[PattientController::class,'cetakRekamedik']);
            }
        );

        Route::prefix('admin')->name('admin.')->group(
            function () {
                Route::get('/', [AdminController::class, 'index'])->middleware('isAdmin');
                Route::post('store', [AdminController::class, 'store'])->middleware('isAdmin');
                Route::put(
                    'update',
                    [AdminController::class, "updateAdmin"]
                )->middleware('isAdmin');
                Route::delete('destroy', [AdminController::class, 'destroy'])->middleware('isAdmin')->name('destroy');
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

                Route::get('/', [MedicinesController::class, "index"]);
                Route::post('store', [MedicinesController::class, "store"]);
                Route::put('update', [MedicinesController::class, "update"]);
                Route::delete('destroy', [MedicinesController::class, "destroy"]);
            }
        )->middleware('isAdmin');;

        Route::prefix('category')->group(
            function () {
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
                    [RecordCategoryController::class, 'update'],
                )->middleware('isAdmin');
                Route::delete(
                    'destroy',
                    [RecordCategoryController::class, 'destroy']
                )->middleware('isAdmin');
            }
        )->middleware('isAdmin');

        Route::controller(ScheduleDetailController::class)->prefix('schedule')->group(function () {
            Route::get('/', 'index');
            Route::post('/store', 'store');
            Route::put('/update', 'update');
            Route::delete('/destroy', 'destroy');
        })->middleware('isAdmin');

        Route::prefix('consul')->group(
            function () {
                Route::get(
                    '/',
                    [RecordController::class, 'showConsulOnAdmin']
                )->middleware('isAdmin');;
                //startCoverenceByAdmin
                Route::get('vidcon/{id_consul}', [RecordController::class, "startCoverenceByAdmin"])->middleware('isAdmin');;
                Route::post(
                    'receipt/store',
                    function (Request $request) {
                        $detailController = new RecipeDetailController();
                        $recipeController = new RecipeController();
                        $isThereRecipe = $recipeController->checkRecipe($request->id_consule);
                        $medicineService = new MedicineService();
                        $id = null;
                        if ($isThereRecipe) {
                            $idresponse = $recipeController->store($request->id_consule);
                            $id = $idresponse['id'];
                        } else {
                            $id = $recipeController->getLastInsertID();
                        };
                        $obat = $medicineService->findById($request->id_medicine);
                        $response = [
                            'id' => $request->id_medicine,
                            'name' => $obat->name,
                            'qty' => $request->input('qty', 'qty kosong'),
                            'harga' => $obat->price,
                            'total' => $obat->price * $request->qty
                        ];
                        $data = [
                            'id_consule' => $request->id_consule,
                            'id_recipe' => $id,
                            "id_medicine" => $request->id_medicine,
                            "qty" => $request->qty,
                            "total" => $response['total']
                        ];
                        $isThere = $detailController->checkMedicine($id, $request->id_medicine);
                        if ($isThere) {
                            $detailController->store($data);
                            $response = [
                                'id' => $request->id_medicine,
                                'name' => $obat->name,
                                'qty' => $request->input('qty', 'qty kosong'),
                                'harga' => $obat->price,
                                'total' => $obat->price * $request->qty,
                                "status" => true
                            ];
                            // http_response_code(201);
                            echo json_encode($response);
                        } else {
                            $response = [
                                "status" => false
                            ];
                            //echo http_response_code(409);
                        }
                    }
                )->name("receipt.store")->middleware('isAdmin');

                Route::delete(
                    'receipt/destroy',
                    function (Request $request) {
                        //request {'id':'id obat yang akan dihapus dari resep'}
                        $controller = new RecipeDetailController();
                        $isDelete = $controller->delete($request->id_consule, $request->id);
                        $response = [
                            'status' => $isDelete
                        ];
                        echo json_encode($response);
                    }
                )->name('receipt.destroy')->middleware('isAdmin');;
            }
        );

        Route::prefix('poly')->group(
            function () {
                Route::get('/', [PolyclinicController::class, 'index']);
                Route::post('store', [PolyclinicController::class, 'store']);
                Route::put('update', [PolyclinicController::class, 'update']);
                Route::delete('destroy', [PolyclinicController::class, 'destroy']);
            }
        )->middleware('isAdmin');;

        Route::controller(DoctorController::class)->prefix('/doctor')->group(function () {
            Route::get('/', 'index');
            Route::post('/store', 'store');
            Route::put('/update', 'update');
            Route::delete('/destroy', 'destroy');
        })->middleware('idAdmin');

        Route::prefix('receiptProof')->group(
            function () {
                Route::get('/', [RecipeController::class, 'displayDataRequiresApproval'])->middleware('isAdmin');;

                Route::put('update', [RecipeController::class, 'acceptOrRejectMedicinePayment'])->middleware('isAdmin');;
            }
        );

        Route::prefix('delivery')->group(
            function () {
                Route::get('/', [RecipeController::class, 'showDataDelivery'])->middleware('isAdmin');;
                Route::put('update', [RecipeController::class, 'actionDelivery'])->middleware('isAdmin');;
            }
        );

        Route::prefix('setting')->group(function () {
            Route::get('/', [AdminController::class, 'displayDataAdmin'])->middleware('isAdmin');;

            Route::prefix('update')->group(function () {
                Route::put('password', [AdminController::class, 'updatePassword'])->middleware('isAdmin');;

                Route::put('email', [AdminController::class, 'updateEmail'])->middleware('isAdmin');;

                Route::put('/', [AdminController::class, 'update'])->middleware('isAdmin');;
            });
        });
    }

);


//dokter
Route::prefix('doctor')->group(function () {
    Route::middleware('guestDoctor')->prefix('login')->group(function () {
        Route::get('/', [AuthDoctorController::class, 'index']);
        Route::post('/', [AuthDoctorController::class, 'authenticate']);
    });

    Route::redirect('/', '/doctor/consul');
    Route::redirect('/dashboard', '/doctor/consul');


    Route::middleware('isDoctor')->prefix("/consul")->group(function () {
        Route::get('/', [RecordController::class, "showConsulByDoctor"]);
        Route::get('jitsi/{id_consul}', [RecordController::class, "getJitsiDocter"]);
    });

    Route::get('/schedule', [DoctorScheduleController::class, 'index'])->middleware('isDoctor');

    Route::middleware('isDoctor')->prefix('category')->group(function () {
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

    Route::middleware('isDoctor')->prefix('setting')->group(function () {
        Route::controller(DoctorSettingController::class)->group(function () {
            Route::get('/', 'index');
            Route::prefix('/update')->group(function () {
                Route::put('/', 'update');
                Route::put('/email', 'email');
                Route::put('/password', 'password');
            });
        });
    });
    
    Route::middleware('isDoctor')->prefix('complain')->group(
        function () {
            Route::get(
                '/',
                [RecordController::class, 'showComplaintOnDoctor']
            )->middleware('isDoctor');

            Route::put(
                'agreement',
                [RecordController::class, 'confirmStatusPayment']
            )->middleware('isDoctor');
        }
    );

    Route::get('/logout', [AuthDoctorController::class, 'logout'])->middleware('isDoctor');
});

// Logout ( Clear all session pacient )
Route::get("/keluar", [PattientController::class, 'logout']);

Route::get('setstatus', [RecordController::class, 'setStatusToComplete'])->name('set.status');
