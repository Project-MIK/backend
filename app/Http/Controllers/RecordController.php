<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecordStoreRequest;
use App\Services\RecordService;
use Illuminate\Http\Request;

class RecordController extends Controller
{

    private RecordService $service;


    public function __construct(){
        $this->service = new RecordService();
    }
    //
    public function index(){
        return $this->service->index();
    }

    public function store(RecordStoreRequest $request){

    }

    public function upadate(){

    }

    public function destroy($id){

    }
}
