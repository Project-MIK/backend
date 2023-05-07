<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Http\Requests\StoreAdminRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
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
        $data = $this->admin->get();
        return $data;
    }
    public function store(array $request)
    {
        try {
            $request['password'] = bcrypt($request['password']);
            $this->admin->create($request);
            return true;
        } catch (\Exception $th) {
            return false;
        }
    }
    public function update(array $request): array
    {

        $check = $this->admin->where('id', $request['id'])->first();
        if ($check != null) {
            $isChanged = Helper::compareToArrays($request, $request['id'], 'admin');
            $response = [];
            if ($isChanged) {
                $isUpdate = $this->admin->where('id', $request['id'])->update($request);
                if ($isUpdate) {
                    $response['status'] = true;
                    $response['message'] = 'berhasil memperbarui data admin';

                } else {
                    $response['status'] = false;
                    $response['message'] = 'gagal memperbarui data admin terjadi keslahan saat melakukan update';
                }
            } else {
                $response['status'] = false;
                $response['message'] = 'gagal memperbarui data admin , tidak ada perubahan';
            }
        } else {
            $response['status'] = false;
            $response['message'] = 'gagal memperbarui data admin , admin tidak ditemukan';

        }
        return $response;
    }
    public function findByEmail(string $email)
    {
        $data = $this->admin->where('email', $email)->first();
        return $data;
    }

    public function findByName(string $name)
    {
        $data = $this->admin->Where('name', 'like' . '%' . $name . '%')->get();
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
    public function deleteById($id): bool
    {
        $res = $this->admin->where('id', $id)->first();
        if ($res != null) {
            $res->delete();
            return true;
        } else {
            return false;
        }
    }

    public function updatePassword($id, $password)
    {
        $isUpdate = $this->admin->where('id', $id)->update([
            'password' => bcrypt($password)
        ]);
        if ($isUpdate) {
            return true;
        }
        return false;
    }


    public function login(array $request)
    {
        $res = Auth::guard('admin')->attempt(['email' => $request['email'], 'password' => $request['password']]);
        return $res;
    }

    public function findEmailOtherAdmin($email , $id)
    {
        $response = $this->admin->where('email', '=', $email)->where('id' , $id )->first();
        return $response;
    }

    public function displayDataAdminOnSetting($id)
    {
        $admin = $this->admin->where('id', $id)->first();
        if ($admin != null) {
            return $admin->toArray();
        } else {
            return [];
        }
    }

    public function updateEmail($id, $email)
    {
        $request = [
            'email' => $email
        ];
        $response = [];
        $check = $this->findEmailOtherAdmin($email , $id);
        $isChange = Helper::compareToArrays($request, $id, 'admin');
        if($isChange){
            if ($check != null) {
                $response['status'] = false;
                $response['message'] = 'email sudah digunakan user yang lain';
            } else {
                $isUpdate = $this->admin->where('id', $id)->update([
                    'email' => $email
                ]);
                if ($isUpdate) {
                    $response['status'] = true;
                    $response['message'] = 'Berhasil memperbarui email';
                } else {
                    $response['status'] = false;
                    $response['message'] = 'gagal memperbarui email';
                }
            }
        }else{
            $response['status'] = false;
            $response['message'] = 'tidak ada perubahan email';
        }   
        return $response;
    }
}