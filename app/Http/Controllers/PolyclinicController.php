<?php

namespace App\Http\Controllers;

use App\Http\Requests\PolyclinicStoreRequest;
use App\Http\Requests\PolyclinicUpdateRequest;
use App\Services\PolyclinicService;

class PolyclinicController extends Controller
{
    private PolyclinicService $service;

    public function __construct()
    {
        $this->service = new PolyclinicService();
    }

    public function index()
    {
        $polyclinics = $this->service->findAllPolyclinics();
        $categories = $this->service->findAllCategories();

        return view('admin.poli', [
            'polyclinics' => $polyclinics,
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(PolyclinicStoreRequest $request)
    {
        $validated = $request->validated();
        $response = $this->service->add($validated);

        if ($response) {
            session()->flash("message", "berhasil menambah poliklinik");
        } else {
            session()->flash("message", "gagal menambah poliklinik");
        }

        return redirect('/admin/poly');
    }

    public function show($id)
    {

        $data = $this->service->findById($id);
        return $data;
    }

    public function showByCategory()
    {
        if (!isset(session("consultation")["description"])) return redirect("/konsultasi");

        
        $id = session('consultation')['category'][0];

        $polyclinics = [];
        $data = $this->service->findByCategory($id);
        if($data !== null) {
            foreach ($data as $key => $value) {
                $polyclinics[$value['id']] = $value['name'];
            };
        }
        
        return view('pacient.consultation.polyclinic', compact('polyclinics'));
    }

    public function edit($id)
    {
        $data = $this->service->findById($id);
        return $data;
    }

    public function update(PolyclinicUpdateRequest $request)
    {
        $id = $request->id;
        $validated = $request->validated();
        $response = $this->service->change($validated, $id);
        if ($response) {
            session()->flash("message", "berhasil memperbarui poliklinik");
        } else {
            session()->flash("message", "gagal memperbarui poliklinik");
        }
        
        return redirect('/admin/poly');
    }

    public function destroy()
    {
        $id = request()->id;
        $response = $this->service->deleteById($id);
        if ($response) {
            session()->flash("message", "berhasil menghapus poliklinik");
        } else {
            session()->flash("message", "gagal menghapus poliklinik");
        }

        return redirect('/admin/poly');
    }

    public function searchByName(string $search)
    {
        $data = $this->service->findByName($search);
        return $data;
    }
}
