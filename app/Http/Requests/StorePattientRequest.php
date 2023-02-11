<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StorePattientRequest extends Request
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
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'fullname' => ['required', 'string', 'min:4'],
            'email' => ['required', 'email', 'unique:pattient,email'],
            'gender' => ['required'],
            'password' => ['required'],
            'phone_number' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', 'max:13'],
            'address_RT' => ['required', 'numeric'],
            'address_RW' => ['required', 'numeric'],
            'address_desa' => ['required', 'string'],
            'address_dusun' => ['required', 'string'],
            'address_kecamatan' => ['required', 'string'],
            'address_kabupaten' => ['required', 'string'],
            'citizen' => ['required'],
            'profession' => ['required'],
            'date_birth' => ['required'],
            'blood_group' => ['required'],
            'place_birth' => ['required']
        ];
    }
}
