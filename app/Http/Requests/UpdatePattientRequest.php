<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePattientRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:4'],
            'email' => ['required', 'email'],
            'gender' => ['required'],
            'password' => ['required'],
            'phone_number' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/' , 'min:10' , 'max:13'],
            'address' => ['required', 'string'],
            'citizen' => ['required'],
            'profession' => ['required'],
            'date_birth' => ['required'],
            'blood_group' => ['required'],
            'place_birth' => ['required']
        ];
    }
}