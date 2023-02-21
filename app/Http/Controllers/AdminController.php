<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\KeyRequest;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use App\Services\AdminService;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    private AdminService $service;

    public function __construct()
    {
        // inject dependency injection
        $this->service = new AdminService();
    }

    public function index()
    {
        $data = $this->service->findAll();
        return view("admin.admin", ['data', $data]);
    }
    public function create()
    {
        // please return view to create new admin 
    }

    public function store(StoreAdminRequest $request)
    {
        // bool return
        $response = $this->service->store($request->validate($request->rules()));
        if ($response) {
            $message = ['status' => true, "message" => "berhasil menambahkan data admin"];
            return redirect()->back()->with('message', $message);
        } else {
            $message = ['status' => false, "message" => "gagal menambahkan data admin"];
            return redirect()->back()->with('message', $message);
        }
    }
    public function show(Admin $admin)
    {
        $data = $this->service->findById($admin->id);
        return $data;
    }
    public function edit(Admin $admin)
    {
        $data = $this->service->findById($admin->id);
        return $data;
    }
    public function update(UpdateAdminRequest $request,  Admin $admin)
    {
        $validatedData = $request->validate($request->validate($request->rules()['update']));
        $isChanged = Helper::compareToArrays($validatedData, $admin, 'admin');
        if ($isChanged) {
            $responseAsbool = $this->service->update($request->validate($request->rules()), $admin);
            if ($responseAsbool) {
                // success update
                $message = ['status' => true, "message" => "berhasil memperbarui data admin"];
                return redirect()->back()->with('message', $message);
            } else {
                // failed update
                $message = ['status' => false, "message" => "gagal memperbarui data admin"];
                return redirect()->back()->with('message', $message);
            }
        } else {
            $message = ['status' => false, "message" => "gagal memperbarui data admin , tidak ada perubahan"];
            return redirect()->back()->with('message', $message);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     */
    public function destroy(Admin $admin)
    {
        $res = $this->service->deleteById($admin->id);
        if ($res) {
            // success deelte
            session()->flash("message", "berhasil menghapus admin");
            return redirect('/admin');
        } else {
            // failed delete
            session()->flash("message", "gagal menghapus admin");
            return redirect("/admin");
        }
    }
    public function searchByName(KeyRequest $keyRequest)
    {
        $data = $this->service->findByName($keyRequest->name);
        if ($data->count() > 0) {
            // if data not found , the return is null
            return null;
        } else {
            // use  foreach to access data
            return $data;
        }
    }

    public function searchByEmail(KeyRequest $request)
    {
        // return null if not exist , return array if exist
        return $this->service->findByEmail($request->email);
    }
}
