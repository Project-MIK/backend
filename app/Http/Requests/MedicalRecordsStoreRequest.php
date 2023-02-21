<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicalRecordsStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *s
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
                //
            "medical_record_id" => ["required" , "unique:medical_records,medical_record_id"] , 
            "id_pattient" => ["required" , 'numeric'] ,
            "id_registration_officer" => ["required" , "numeric"] , 
        ];
    }
}
