<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComplaintStoreRequest;
use App\Http\Requests\RecordStoreRequest;
use App\Models\Record;
use App\Services\MedicineService;
use App\Services\RecipeDetailsService;
use App\Services\RecordService;

use Illuminate\Http\Request;

class DoctorComplainController extends Controller
{

    private RecordService $service;

    public function __construct()
    {
        $this->service = new RecordService();
    }

    public function showComplaintOnDoctor()
    {
        $data = $this->service->showComplaintOnAdmin();
        return view('doctor.pages.complain', ['data' => $data]);
    }

    public function confirmStatusPayment(Request $request)
    {
        $res = $this->service->acceptPaymentOrDecline($request->id, $request->status);
        return redirect()->back()->with('message', $res['message']);
    }
}