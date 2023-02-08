<?php

namespace App\Services;

use App\Models\RegistrationOfficers;
use Dotenv\Exception\ValidationException as ExceptionValidationException;
use Illuminate\Validation\ValidationException;

class RegistrationOfficerService
{

    private RegistrationOfficers $model;

    public function __construct()
    {
        $this->model = new RegistrationOfficers();
    }


    public function findAll()
    {
        $data = $this->model->all();
        if ($data->count() == 0) {
            return null;
        }
        return $data;
    }

    public function store(array $request)
    {
        try {
            //code...
            $request['password'] = bcrypt($request['password']);
            $response = $this->model->create($request);
            return $response;
        } catch (ValidationException $th) {
            //throw $th;
            return null;
        }
    }

    public function findById($id)
    {
        $response = $this->model->where('id', $id)->first();
        // return null if not found
        return $response;
    }

    public function update(array $request, $id)
    {
        $data = $this->model->where('id', '<>', $id)->get();
        foreach ($data as $key) {
            if ($key->email == $request['email']) {
                return false;
            }
        }
        try {
            $request['password'] = bcrypt($request['password']);
            $res = $this->model->where('id', $id)->update($request);
            if($res){
                return true;
            }
            return true;
        } catch (ValidationException $th) {
            //throw $th;
            return false;
        }
    }

    public function deleteById($id){
        $res = $this->model->where('id', $id)->delete();
        if($res == 1){
            return true;
        }
        return false;
    }
}
