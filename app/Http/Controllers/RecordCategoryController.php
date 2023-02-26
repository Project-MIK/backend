<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecordCategoryStoreRequest;
use App\Http\Requests\RecordCategoryUpdateRequest;
use App\Services\RecordCategoryService;
use Illuminate\Http\Request;

class RecordCategoryController extends Controller
{
    //
    private RecordCategoryService $service;


    public function __construct()
    {
        $this->service = new RecordCategoryService();
    }

    public function index()
    {
        $data = $this->service->findAll();
        return $data;
    }

    public function store(RecordCategoryStoreRequest $request)
    {

        $rules = [
            'category_name' => ['required', 'min:4', "regex:/^[a-zA-Z]+$/u"],
        ];

        $customMessages = [
            'required' => 'Category Complaint tidak boleh kosong',
            "min" => "Category Complaint harus minimal 4 Character",
            "regex" => "Category Complaint harus berupa huruf"
        ];
        $data = $this->validate($request, $rules, $customMessages);
        $res = $this->service->insert($data);
        if ($res['status']) {
            return redirect()->back()->with("message", $res['message']);
        }
    }

    public function update($id, RecordCategoryUpdateRequest $request)
    {
        $rules = [
            'category_name' => ['required', 'min:4', "regex:/^[a-zA-Z]+$/u", 'unique:record_category,category_name'],
        ];

        $customMessages = [
            'required' => 'Category Complaint tidak boleh kosong',
            "min" => "Category Complaint harus minimal 4 Character",
            "regex" => "Category Complaint harus berupa huruf",
            "unique" => "Nama Category Tidak boleh sama"
        ];
        $data = $this->validate($request, $rules, $customMessages);
        $res = $this->service->update($id, $data);
        return redirect()->back()->with("message", $res['message']);
    }
    public function show($id)
    {
        $res =  $this->service->findByid($id);
        if($res==null){
            return [];
        }
        return $res;
    }

    public function destroy($id)
    {
        $res = $this->service->deleteById($id);
        if($res){
            return redirect()->back()->with("message" , "berhasil menghapus category");
        }else{
            return redirect()->back()->with("message" , "gagal menghapus category");
        }
    }   
}