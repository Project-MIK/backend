<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecordStoreRequest;
use App\Services\RecordService;
use Illuminate\Http\Request;

class RecordController extends Controller
{

    private RecordService $service;


    public function __construct()
    {
        $this->service = new RecordService();
    }
    

    public function store(RecordStoreRequest $request)
    {
        $data = $request->validate($request->rules());
        $res = $this->service->insert($data);
        // $res['status'] = true or false
        return redirect()->back()->with("message", $res['message']);
    }

    public function upadate()
    {

    }


}