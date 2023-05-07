<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\KeyRequest;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use App\Services\AdminService;
use App\Services\PattientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{

    private AdminService $service;
    private PattientService $pattientService;

    public function __construct()
    {
        // inject dependency injection
        $this->service = new AdminService();
        $this->pattientService = new PattientService();
    }

    public function index()
    {
        $data = $this->service->findAll();
        return view("admin.admin", ['data' => $data]);
    }
    public function create()
    {
        // please return view to create new admin 
    }

    public function store(StoreAdminRequest $request)
    {
        // bool return
        $response = $this->service->store($request->validate($request->rules()));
        if ($response) {
            // return redirect('admin/admin')->with('message', 'berhasil menambahkan data admin');
            return redirect()->back()->with('message', "berhasil menambahkan admin baru");
        } else {
            // return redirect('admin/admin')->with('message', 'gagal menambahkan data admin , terjadi kesalahan server');
            return redirect()->back()->withErrors("Gagal menambahkan admin");
        }
    }
    public function show(Admin $admin)
    {
        $data = $this->service->findById($admin->id);
        return $data;
    }
    public function edit(Admin $admin)
    {
        $data = $this->service->findById($admin->id);
        return $data;
    }
    public function update(Request $request)
    {
        
        $rules = [
            'name' => 'required',
            'address' => 'required|max:250',
        ];

        $customMessages = [
            'required' => ':attribute Dibutuhkan.',
        ];
        
        $this->validate($request, $rules, $customMessages);
      
        if(Auth::guard('admin')->check()){
            $request['id'] = Auth::guard('admin')->user()->id;
            $update = $this->service->update($request->except([
                '_token',
                '_method'
            ]));    
            if ($update['status']) {
                return redirect()->back()->with('message', $update['message']);
            } else {
                return redirect()->back()->withErrors($update['message']);
            }
        }else{
            return redirect('admin/login')->withErrors('please login');
        }

      
    }


    public function updatePassword(Request $request)
    {
        $password1 = $request->password;
        $password2 = $request->confirm_password;
        $rules = [
            'password' => 'required',
            'confirm_password' => 'required',
        ];

        $customMessages = [
            'required' => ':attribute Dibutuhkan.',
        ];

        $this->validate($request, $rules, $customMessages);

        if ($password1 != $password2) {
            return redirect()->back()->withErrors("gagal memperbarui password password tidak sama");
        } else {
            $response = $this->service->updatePassword(Auth::guard('admin')->user()->id,$password1);
            if ($response) {
                return redirect()->back()->with('message', 'berhasil memperbarui password');
            } else {
                return redirect()->back()->withErrors("Gagal memperbarui  password terjadi kesalahan");
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     */
    public function destroy(Admin $admin)
    {
      
        $res = $this->service->deleteById($admin->id);
        if ($res) {
            // success deelte
            session()->flash("message", "berhasil menghapus admin");
            return redirect('/admin/admin');
        } else {
            // failed delete
            session()->flash("message", "gagal menghapus admin");
            return redirect("/admin/admin");
        }
    }
    public function searchByName(KeyRequest $keyRequest)
    {
        $data = $this->service->findByName($keyRequest->name);
        if ($data->count() > 0) {
            // if data not found , the return is null
            return null;
        } else {
            // use  foreach to access data
            return $data;
        }
    }

    public function searchByEmail(KeyRequest $request)
    {
        // return null if not exist , return array if exist
        return $this->service->findByEmail($request->email);
    }

    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $res = $this->service->login($data);
        if ($res) {
            return redirect('admin')->with('message', 'Berhasil login');
        } else {
            return Redirect::back()->withErrors(['msg' => 'Password atau Email Kamu Salah']);
        }
    }
    public function updateDataPattient(Request $request)
    {
    
        // need id
        if ($request->medical_record_id != null) {
            //dd($request);

            $model = $this->pattientService->findByMedicalRecord($request->medical_record_id);
            $id = $model->id;
            $rules = [
                'fullname' => ['required', 'min:4'],
                'address_RT' => ['required', 'min:2', 'max:3'],
                'address_RW' => ['required', 'min:2', 'max:3'],
                'address_desa' => ['required', 'max:20', 'min:4'],
                'address_kecamatan' => ['required', 'max:20', 'min:4'],
                'address_kabupaten' => ['required', 'max:20', 'min:4'],
                'no_telp' => ['required', 'min:10', 'max:13'],
                'address_dusun' => ['required', 'max:20', 'min:4'],

            ];
            if ($request->citizen == 'WNI') {
                $rules['nik'] = ['required', 'digits:16'];
                $customMessages = [
                    'fullname.required' => 'Nama lengkap tidak boleh kosong.',
                    'fullname.min' => 'Nama lengkap tidak boleh kurang dari 4 digit',
                    'address_RT.required' => 'RT tidak boleh kosong',
                    'address_RT.min' => 'RT tidak boleh kurang dari 2 digit',
                    'address_RT.max' => 'RT tidak boleh lebih dari 3 digit',
                    'address_desa.required' => 'Desa tidak boleh kosong',
                    'address_desa.max' => 'Desa tidak boleh lebih dari 20 digit',
                    'address_desa.min' => 'Desa tidak boleh kurang dari 4 digit',
                    'address_dusun.required' => '-Dusun tidak boleh kosong',
                    'address_dusun.max' => '-Dusun tidak boleh lebih dari 20 digit',
                    'address_dusun.min' => 'Dusun tidak boleh kurang dari 4 digit',
                    'address_kecamatan.required' => 'Kecamatan tidak boleh kosong',
                    'address_kecamatan.min' => 'Kecamatan tidak boleh kurang dari 4 digit',
                    'address_kecamatan.max' => 'Kecamatan tidak boleh lebih dari 20 digit',
                    'address_kabupaten.required' => 'Kabupaten tidak boleh kosong',
                    'address_kabupaten.max' => 'Kabupaten tidak boleh lebih dari 20 digit',
                    'address_kabupaten.min' => 'kabupaten tidak boleh kurang dari 4 digit',
                    'no_telp.required' => 'No Hp tidak boleh kosong',
                    'no_telp.min' => 'no Hp tidak boleh kurang dari 10 digit',
                    'no_telp.max' => 'no Hp tidak boleh lebih dari 13 digit'
                ];
                $this->validate($request, $rules, $customMessages);
                $checkNik = $this->pattientService->checkNik($id, $request->nik);
                // jika checknik true maka nik tidak ada yang digunakan
                $this->validate($request, $rules, $customMessages);
                if ($checkNik) {
                    return redirect()->back()->withErrors(['msg' => 'nik sudah digunakan olah pengguna lain']);
                }
            } else {
                $checkPaspor = $this->pattientService->checkNoPaspor($id, $request->nik);
                
                if ($checkPaspor) {
                    return redirect()->back()->withErrors(['msg' => 'no paspor sudah digunakan olah pengguna lain']);
                }
                
                $request['no_paspor'] = $request->nik;
                $rules['no_paspor'] = ['required', 'digits:16'];
              //  $rules['nik'] = ['required', 'digits:16', 'unique:pattient,no_paspor'];
                $customMessages = [
                    'fullname.required' => 'Nama lengkap tidak boleh kosong.',
                    'fullname.min' => 'Nama lengkap tidak boleh kurang dari 4 digit',
                    'address_RT.required' => 'RT tidak boleh kosong',
                    'address_RT.min' => 'RT tidak boleh kurang dari 2 digit',
                    'address_RT.max' => 'RT tidak boleh lebih dari 3 digit',
                    'address_desa.required' => 'Desa tidak boleh kosong',
                    'address_desa.max' => 'Desa tidak boleh lebih dari 20 digit',
                    'address_desa.min' => 'Desa tidak boleh kurang dari 4 digit',
                    'address_dusun.required' => 'Dusun tidak boleh kosong',
                    'address_dusun.max' => 'Dusun tidak boleh lebih dari 20 digit',
                    'address_dusun.min' => 'Dusun tidak boleh kurang dari 4 digit',
                    'address_kecamatan.required' => 'Kecamatan tidak boleh kosong',
                    'address_kecamatan.min' => 'Kecamatan tidak boleh kurang dari 4 digit',
                    'address_kecamatan.max' => 'Kecamatan tidak boleh lebih dari 20 digit',
                    'address_kabupaten.required' => 'Kabupaten tidak boleh kosong',
                    'address_kabupaten.max' => 'Kabupaten tidak boleh lebih dari 20 digit',
                    'address_kabupaten.min' => 'kabupaten tidak boleh kurang dari 4 digit',
                    'no_telp.required' => 'No Hp tidak boleh kosong',
                    'no_telp.min' => 'no Hp tidak boleh kurang dari 10 digit',
                    'no_telp.max' => 'no Hp tidak boleh lebih dari 13 digit',
                    "no_paspor.digits" => "no paspor harus 16 digits" 
                ];
              
                $this->validate($request, $rules, $customMessages);
            }
            $data = $request->except([
                'address_RT',
                'address_RW',
                'address_dusun',
                'address_desa',
                'address_kecamatan',
                'address_kabupaten',
                'no_telp',
                'fullname',
                'birth_date',
                '_token',
                'email',
                '_method'
            ]);
            if(isset($data['no_paspor'])){
                unset($data['nik']);
            }
            $data['date_birth'] = $request->date_birth;
            $data['name'] = $request->fullname;
            $data['address'] = $request->address_RT . '/' . $request->address_RW . '/' . $request->address_dusun . '/' . $request->address_desa . '/' . $request->address_kecamatan . '/' . $request->address_kabupaten;
            $data['phone_number'] = $request->no_telp;
            $res = $this->pattientService->updateDataPattient($data, $id);
            if ($res) {
                return redirect()->back()->with('message', 'berhasil memperbarui data');
            } else {
                return redirect()->back()->withErrors(['msg' => 'Gagal Memperbarui Tidak ada perubahan data']);
            }
        } else {
            return redirect()->back()->withErrors("id parameter tidak valid");
        }

    }


    public function updateAdmin(Request $request)
    {
        $res = $this->service->update($request->except(['_token', '_method']));
        if ($res['status']) {
            return redirect('admin/admin')->with('message', $res['message']);
        } else {
            return redirect('admin/admin')->withErrors($res['message']);
        }

    }

    public function displayDataAdmin(){
        $data = $this->service->displayDataAdminOnSetting(Auth::guard('admin')->user()->id);
        return view('admin.setting' , ['data' => $data]);
    }

    public function updateEmail(Request $request){
        $rules = [
            'email' => 'required|email',
        ];

        $customMessages = [
            'required' => ':attribute Dibutuhkan.',
            'email' => 'email tidak valid'
        ];
        $this->validate($request, $rules, $customMessages);

        $response = $this->service->updateEmail(Auth::guard('admin')->user()->id , $request->email);
        if($response['status']){
            return redirect()->back()->with('message' , $response['message']);
        }else{
            return redirect()->back()->withErrors($response['message']);
        }
    }


    public function logout(){
        Auth::guard('admin')->logout();
        return redirect("/admin/login")->with('message' , 'success logout');
    }

}