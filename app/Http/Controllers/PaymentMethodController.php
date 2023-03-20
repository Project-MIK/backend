<?php

namespace App\Http\Controllers;

use App\Services\PaymentMethodService;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    //
    private PaymentMethodService $service;


    public function __construct()
    {
        $this->service = new PaymentMethodService();
    }

    public function index()
    {
        return $this->service->findAll();
    }
}