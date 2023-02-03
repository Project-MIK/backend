<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationOfficersRequest;
use App\Models\RegistrationOfficers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrationOfficersController extends Controller
{
    public function index()
    {
        $dataOfficers = RegistrationOfficers::orderBy("id" , "desc")->get();
        return view("officers.index" , ["data" => $dataOfficers]);
    }
    public function create()
    {
        return view("officers.create");
    }
    public function store(RegistrationOfficersRequest $request)
    {
        RegistrationOfficers::create([
            "name" => $request->name,
            "email" => $request->email,
            "gender" => $request->gender,
            "password" => Hash::make($request->password),
            "address" => $request->address
        ]);
        return redirect('/officers')->with(["message" => "Berhasil menambahkan pegawai"]);
    }
    public function show($id)
    {
        $data = RegistrationOfficers::findOrFail($id);
        return view('officers.officers', ['data' => $data]);
    }
    public function edit()
    {
        return view("officers.edit");
    }
    public function update(RegistrationOfficersRequest $request, $id)
    {
        // use key in array on frontend to send your value
        RegistrationOfficers::where('id', $id)->update([
            "name" => $request->name,
            "email" => $request->email,
            "gender" => $request->gender,
            "password" => bcrypt($request->password),
            "address" => $request->address
        ]);
        session()->flash("message", "berhasil memperbarui data pegawai registration");
        return view('officers.edit');
    }
    
    public function destroy($id)
    {
        $res = RegistrationOfficers::where('id', $id)->delete();
        if($res){
            session()->flash("message", "berhasil menghapus data");
        }else{
            session()->flash("message", "gagal menghapus data , data tidak ditemukan");
        }
        return redirect("officers.officers");
    }
    
}
