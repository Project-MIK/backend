<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Models\Medicines;

class MedicineService{

    private Medicines $model;


    public function __construct(){
        $this->model = new Medicines();
    }

    public function findAll(){
        $responseData = $this->model->all()->toArray();
        foreach ($responseData as $key => $value) {
            # code...
            unset($responseData[$key]['created_at'],$responseData[$key]['updated_at']);
        }
        return $responseData;
    }


    public function findWhereStockNotEmpty(){
        $responseData = $this->model->where("stock"  , "<>" , 0)->get()->toArray();
        foreach ($responseData as $key => $value) {
            # code...
            unset($responseData[$key]['created_at'],$responseData[$key]['updated_at']);
        }
        return $responseData;
    }

    public function findById($id){
        $data = $this->model->where('id' , $id)->first();
        return $data;
    }

    public function insert(array $request){
      try {
        $this->model->create($request);
        return true;
      } catch (\Exception $th) {
        //throw $th;
        return false;
      }
    }


    public function update(array $request , $id){
        $isChanged = Helper::compareToArrays($request, $id, 'medicines');
        $response = [];
        if ($isChanged) {
            $data = $this->model->where('id' , '<>' , $id)->get()->toArray();
            foreach ($data as $key) {
                # code...
                if($key['name'] == $request['name']){
                    $response['status'] = false;
                    $response['message'] = 'nama obat sudah digunakan';
                    return $response;
                }
            }
            if ($this->model->where('id', '=', $id)->count() > 0) {
                $data = $this->model->find($id);
                $data->update($request);
                $response['status'] = true;
                $response['message'] = 'berhasil memperbarui data obat';
                return $response;
            } else {
                $response['status'] = false;
                $response['message'] = 'gagal memperbarui data obat , data tidak ditemukan';
                return $response;
            }
        } else {
            $response['status'] = false;
            $response['message'] = 'gagal memperbarui data obat , tidak ada perubahan';
            return $response;
        }
    }

    public function destroy($id){
        $res = $this->model->where('id' , $id)->delete();
        if($res){
            return true;
        }
        return false;
    }

}