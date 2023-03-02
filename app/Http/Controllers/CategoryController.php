<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    private CategoryService $service;

    public function __construct()
    {
        $this->service = new CategoryService();
    }

    public function index()
    {
        $data = $this->service->findAll();

        return $data;
    }

    public function create()
    {
        //
    }

    public function store(CategoryStoreRequest $request)
    {
        $response = $this->service->add($request->validate($request->rules()));

        if ($response) {
            session()->flash("message", "berhasil menambah kategori");
        } else {
            session()->flash("message", "gagal menambah kategori");
        }

        return $response;
    }

    public function show($id)
    {
        $data = $this->service->findById($id);

        return $data;
    }

    public function edit($id)
    {
        //
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        $response = $this->service->change($request->validate($request->rules()), $id);

        if ($response) {
            session()->flash("message", "berhasil memperbarui kategori");
        } else {
            session()->flash("message", "gagal memperbarui kategori");
        }

        return $response;
    }

    public function destroy($id)
    {
        $response = $this->service->delete($id);

        if ($response) {
            session()->flash("message", "berhasil menghapus kategori");
        } else {
            session()->flash("message", "gagal menghapus kategori");
        }

        return $response;
    }
}
