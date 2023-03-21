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
        $categories = [];
        $data = $this->service->findAll();
        foreach ($data as $key => $value) {
            # code...
            $categories[$value['id']] = $value['category_name'];
        }
        ;
        return view("pacient.consultation.complaint", compact('categories'));
    }

    public function indexAdmin()
    {
        $data = $this->service->findAll();
        foreach ($data as $key => $value) {
            # code...
            $data[$key]['category'] = $data[$key]['category_name'];
            $data[$key]['id_category'] = $data[$key]['id'];
            unset($data[$key]['category_name'], $data[$key]['id']);
        }
        return view('admin.category', compact('data'));
    }

    public function store(RecordCategoryStoreRequest $request)
    {

        $rules = [
            'category' => ['required', 'min:4'],
        ];
        $customMessages = [
            'required' => 'Category Complaint tidak boleh kosong',
            "min" => "Category Complaint harus minimal 4 Character",
        ];
        $data = $this->validate($request, $rules, $customMessages);
        $res = $this->service->insert($data);
        return redirect()->back()->with("message", $res['message']);
    }

    public function update(Request $request)
    {
        $rules = [
            'category' => ['required', 'min:4', "regex:/^[a-zA-Z]+$/u", 'unique:record_category,category_name'],
        ];

        $customMessages = [
            'required' => 'Category Complaint tidak boleh kosong',
            "min" => "Category Complaint harus minimal 4 Character",
            "regex" => "Category Complaint harus berupa huruf",
            "unique" => "Nama Category Tidak boleh sama"
        ];
        $id = $request->id_category;
        $data = $this->validate($request, $rules, $customMessages);
        $res = $this->service->update($id, $data);
        if ($res['status']) {
            return redirect()->back()->with("message", $res['message']);
        }else{
            return redirect()->back()->withErrors($res['message']);
        }

    }
    public function show($id)
    {
        $res = $this->service->findByid($id);
        if ($res == null) {
            return [];
        }
        return $res;
    }

    public function destroy(Request $request)
    {
        $res = $this->service->deleteById($request->id_category);
        if ($res) {
            return redirect()->back()->with("message", "berhasil menghapus category");
        } else {
            return redirect()->back()->withErrors("gagal menghapus category");
        }
    }

    public function showDataCategoryOnPolyclinic()
    {
        $data = $this->service->showDataCategory();
        if (sizeof($data) > 0) {
            foreach ($data as $key => $value) {
                # code...
                $data[$key]['id_category'] = $value['id'];
                $data[$key]['category'] = $value['category_name'];
                unset($data[$key]['id'], $data[$key]['category_name']);
            }
        } else {
            return redirect('category')->withErrors('category kosong silahkan tambahkan category terlebih dahulu');
        }
        return $data;
    }
}