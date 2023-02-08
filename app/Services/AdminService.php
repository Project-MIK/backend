<?php

namespace App\Services;

use App\Http\Requests\StoreAdminRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    private Admin $admin;

    public function __construct()
    {
        $this->admin = new Admin();
    }

    public function findAll()
    {
        $data =  $this->admin->get();
        return $data;
    }
    public function store(array $request)
    {
        try {
            $this->admin->create($request);
            return true;
        } catch (\Exception $th) {
            return false;
        }
    }
    public function update(array $request, Admin $admin)
    {
        if ($this->admin->where('id', '=', $admin->id)->count() > 0) {
            $data = $this->admin->find($admin->id);
            $data->update($request);
            return true;
        } else {
            return false;
        }
    }
    public function findByEmail(string $email)
    {
        $data = $this->admin->where('email', $email)->first();
        return $data;
    }

    public function findByName(string $name)
    {
        $data = $this->admin->Where('name', 'like'. '%'.$name.'%')->get();
        return $data;
    }

    public function findById($id)
    {
        $data = $this->admin->where('id', $id)->first();
        // return null if not exist , array if exist
        return $data;
    }

    public function sendEmailVerification()
    {
        // todo send email
    }
    public function deleteById($id):bool{
        $res = $this->admin->where('id', $id)->first();
        if($res!=null){
            $res->delete();
            return true;
        }else{
            return false;
        }
    }
    
}
