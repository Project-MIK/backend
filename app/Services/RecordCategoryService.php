<?php

namespace App\Services;

use App\Models\Record;
use App\Models\RecordCategory;

class RecordCategoryService
{

    private RecordCategory $recordCategory;


    public function __construct()
    {
        $this->recordCategory = new RecordCategory();
    }


    public function findAll()
    {
        $response = $this->recordCategory->all()->toArray();
        return $response;
    }

    public function insert(array $request)
    {
        $request['category_name'] = $request['category'];
        unset($request['category']);
        $response = [];
        $checkNameCategory = $this->recordCategory->where('category_name', $request['category_name'])->first();
        if ($checkNameCategory == null) {
            $this->recordCategory->create(
                [
                    'category_name' => strtoupper($request['category_name'])
                ]
            );
            $response['status'] = true;
            $response['message'] = "berhasil menambahkan data category";
            return $response;
        }else{
            $response['status'] = false;
            $response['message'] = "gagal menambahkan data category , category tidak boleh sama";
            return $response;
        }
       
    }

    public function update($id, array $request)
    {
        $response = [];
        $checkCategoryNull = $this->recordCategory->where('id', $id)->first();
        if ($checkCategoryNull == null) {
            $response['status'] = false;
            $response['message'] = 'gagal memperbarui data category , category tidak ditemukan';
            return $response;
        } else {
            $checkNameCategory = $this->recordCategory->where('category_name', $request['category_name'])->first();
            if ($checkNameCategory != null) {
                $response['status'] = false;
                $response['message'] = "gagal menambahkan data category , category tidak boleh sama";
                return $response;
            }else{
                $isUpdate = $this->recordCategory->where('id' , $id)->update([
                    "category_name" => $request['category_name']
                ]);
                if($isUpdate){
                    $response['status'] = true;
                    $response['message'] = "berhasil memperbarui data category";
                    return $response;
                }else{
                    $response['status'] = false;
                    $response['message'] = "gagal memperbarui data category";
                    return $response;
                }
            }
        }
    }

    public function findByid($id){
       return $this->recordCategory->where('id' , $id)->first();
    }

    public function deleteById($id){
       $isDelete =  $this->recordCategory->where('id' , $id)->delete();
        if($isDelete){
            return true;
        }
        return false;
    }

    public function showDataCategory(){
        $res = $this->recordCategory->all()->toArray();
        return $res;
    }

   

   
}

?>