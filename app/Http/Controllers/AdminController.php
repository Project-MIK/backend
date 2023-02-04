<?php

namespace App\Http\Controllers;

use App\Http\Requests\KeyRequest;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use App\Services\AdminService;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    private AdminService $service;

    public function __construct(){
        // inject dependency injection
        $this->service = new AdminService();
    }

    public function index()
    {
        $data = $this->service->getAllData();
        return $data;
    }
    public function create()
    {
        // please return view to create new admin 
    }

    public function store(StoreAdminRequest $request)
    {
        // bool return
        $response = $this->service->store($request->validate($request->rules()));
        return $response;
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
        $responseAsbool = $this->service->update($request->validate($request->rules()), $admin);
        if($responseAsbool){
            // success update
            session()->flash("message", "berhasil memperbarui admin");
        }else{
            // failed update
            session()->flash("message", "gagal memperbarui admin");
        }
        return $responseAsbool;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     */
    public function destroy(Admin $admin)
    {
        $res = $this->service->deleteById($admin->id);
        if($res){
            // success deelte
            session()->flash("message", "berhasil menghapus admin");
        }else{
            // failed delete
            session()->flash("message", "gagal menghapus admin");
        }
        return $res;
    }
    public function findByname(KeyRequest $keyRequest){
        $data = $this->service->findByName($keyRequest->name);
        if($data->count() > 0){
            // if data not found , the return is null
            return null;
        }else{
            // use  foreach to access data
            return $data;
        }
    }
    public function findByEmail(KeyRequest $request){
        // return null if not exist , return array if exist
        return $this->service->findByEmail($request->email);
   }
}
