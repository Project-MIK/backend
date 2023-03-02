<?php 

namespace App\Services;

use App\Models\Category;
use Exception;

class CategoryService {
    public function findAll()
    {
        $data = Category::all();

        if($data->isEmpty()) {
            return null;
        } else {
            return $data;
        }
    }

    public function findById($id)
    {
        $data = Category::where('id', $id)->get();

        if($data->isEmpty()) {
            return null;
        } else {
            return $data;
        }
    }

    public function add(array $request)
    {
        try {
            Category::create($request);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function change(array $request, $id) {
        $data = Category::find($id);

        if($data != null) {
            $data->update($request);
            return true;
        } else {
            return false;
        }
    }

    public function delete($id) {
        $data = Category::find($id);

        if($data != null) {
            $data->delete();
            return true;
        } else {
            return false;
        }
    }
}