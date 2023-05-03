<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorLoginRequest;
use App\Services\DoctorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthDoctorController extends Controller
{
    protected DoctorService $service;

    public function __construct()
    {
        $this->service = new DoctorService();
    }

    public function index()
    {
        return view('doctor.pages.login');
    }

    public function authenticate(DoctorLoginRequest $request)
    {
        $credentials = $request->validate($request->rules());
 
        $response = $this->service->login($credentials);

        if ($response) {
            request()->session()->regenerate();

            return redirect()->intended('/doctor/dashboard');
        }

        return back()->withErrors([
            'message' => 'Login anda gagal!'
        ]);
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/doctor/login');
    }
}
