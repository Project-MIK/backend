<?php

namespace App\Services;

use App\Models\Pattient;
use App\Models\Recipes;
use App\Models\Record;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecipesService
{

    private Recipes $model;
    private Record $record;

    private Pattient $pattient;


    public function __construct()
    {
        $this->pattient = new Pattient();
        $this->model = new Recipes();
        $this->record = new Record();
    }


    public function insert($id)
    {
        $response = [];
        $res = $this->model->create([
            "price_medical_prescription" => 0,
            "pickup_medical_prescription" => "hospital-pharmacy",
            "pickup_medical_status" => "MENUNGGU DIAMBIL",
        ]);
        if ($res) {
            $response['status'] = true;
            $response['id'] = $res->id;
            $this->record->Where('id', $id)->update([
                'id_recipe' => $res->id
            ]);
            return $response;
        } else {
            $response['status'] = false;
            $response['id'] = null;
            return $response;
        }

    }
    public function checkFindByIdInRecord($id)
    {
        $res = $this->record->where('id', $id)->first();
        if ($res->id_recipe != null) {
            return false;
        }
        return true;
    }

    public function update_total_price($total, $id)
    {
        $isUpdate = $this->model->where('id', $id)->update([
            'price_medical_prescription' => $total,
        ]);
        if ($isUpdate) {
            return true;
        }
        return false;
    }


    public function getLastInsertId()
    {
        $res = $this->model->orderBy('created_at', 'desc')->first();
        return $res->id;
    }

    public function findById($idRecipe)
    {
        return $this->model->where('id', $idRecipe)->first();
    }

    public function updateBuktiMedicalPrescription(Request $request, $id)
    {
        $record = Record::where('id', $id)->first();
        if ($record != null) {
            $payment = $request->only('bank-payment');
            $file = $request->file('upload-proof-payment');
            // nama file
            $fileName = $file->getClientOriginalName();
            // ekstensi file
            $fileExtension = $file->getClientOriginalExtension();

            $fullName = md5($fileName . random_int(1000, 9999)) . "." . $fileExtension;
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'bukti_pembayaran_recipe';

            $res = DB::table('recipes')->where('id', $record->id_recipe)->update(
                [
                    "proof_payment_medical_prescription" => $fullName,
                    'status_payment_medical_prescription' => 'PROSES VERIFIKASI',
                ]
            );
            if ($res) {
                $file->move($tujuan_upload, $fullName);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }


    public function displayDataRequiresApproval()
    {
        $data = $this->pattient
            ->join('medical_records', 'pattient.medical_record_id', 'medical_records.medical_record_id')
            ->join('record', 'record.medical_record_id', 'medical_records.medical_record_id')
            ->join('recipes', 'recipes.id', 'record.id_recipe')
            ->join('recipe_detail', 'recipe_detail.id_recipe', 'recipes.id')
            ->select('pattient.name as nama_pasien', 'record.id as id_consul', 'recipes.id as id_recipe', 'recipes.price_medical_prescription as total_harga', 'recipes.proof_payment_medical_prescription as bukti', 'recipes.status_payment_medical_prescription as status')
            ->where('recipes.status_payment_medical_prescription', '<>', 'BELUM TERKONFIRMASI')
            ->get()
            ->toArray();
        foreach ($data as $key => $value) {
            # code...
            $listObat = $this->model->join('recipe_detail', 'recipes.id', 'recipe_detail.id_recipe')
                ->join('medicines', 'medicines.id', 'recipe_detail.id_medicine')
                ->select('medicines.name as nama_obat', 'medicines.price as harga', 'recipe_detail.qty as qty')
                ->where('recipe_detail.id_recipe', $value['id_recipe'])
                ->get()->toArray();
            $data[$key]['list_medicine'] = $listObat;
        }
        return $data;
        ;
    }

    public function acceptOrReject(array $request)
    {
            /*
            request = [
            id_recipe => 1,
            id_consule => klsasd,
            status => 'terkonfirmasi atau dibatalkan'
            ];
            */
        if ($request['status'] == 'DIBATALKAN') {
            $isUpdate = $this->model->where('id', $request['id_recipe'])->update([
                'status_payment_medical_prescription' => 'DIBATALKAN'
            ]);
            if ($isUpdate) {
                // konsultasi di anggap selesai
                $isUpdateRecord = $this->record->where('id', $request['id_consule'])->update(
                    [
                        'status_consultation' => 'consultation-complete'
                    ]
                );
                if ($isUpdateRecord) {
                    return true;
                }
                return false;
            }
            return false;
        } else if ($request['status'] == 'TERKONFIRMASI') {
            $isUpdate = $this->model->where('id', $request['id_recipe'])->update([
                'status_payment_medical_prescription' => 'TERKONFIRMASI'
            ]);
            if ($isUpdate) {
                // konsultasi di anggap dilanjutkan dengan kondisi membeli obat
                $isUpdateRecord = $this->record->where('id', $request['id_consule'])->update(
                    [
                        'status_consultation' => 'confirmed-medical-prescription-payment',
                        'valid_status' => Carbon::now()->addHours(1) // tambahkan valid status untuk mengkonfirmasi pengambilan obat
                    ]
                );
                if ($isUpdateRecord) {
                    return true;
                }
                return false;
            }
            return false;
        }
    }
}

?>