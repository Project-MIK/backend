<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index()
    {
        $data = Admin::all();
        return $data;
    }


    public function create()
    {
        return redirect("admin/create");
    }

    public function store(StoreAdminRequest $request)
    {
        $insertData = $request->all();
        $response = Admin::create($insertData);
        if($response){
            session()->flash("message", "berhasil menambahkan data admin");
        }else{
            session()->flash("message", "gagal menambahkan data admin");
        }
        return back();
    }


    public function show(Admin $admin)
    {
        $data = Admin::find($admin);
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        $data = Admin::find($admin);
        return $data;
    }

    public function update(UpdateAdminRequest $request,  Admin $admin)
    {
        if (Admin::where('id', '=', $admin->id)->count() > 0) {
            $data = Admin::find($admin->id);
            $data->update([
                "name" => $request->name,
                "email"=>$request->email,
                "password"=> Hash::make($request->password),
                "address"=> $request->address,
            ]);
            session()->flash("message", "berhasil update");
         }else{
            session()->push('message', "gagal update data , data tidak ditemukan");
         }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     */
    public function destroy(Admin $admin)
    {
        $res = Admin::where('id', $admin->id)->delete();
        if($res){
            response(302);
            session()->flash("message", "berhasil menghapus admin");
        }else{
            response(404);
            session()->flash("message", "gagal menghapus admin");
        }
        return view("admin.index");
    }
}
