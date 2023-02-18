<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'gender' => ['required', 'in:W,M', 'string'],
            'address' => ['required', 'min:8', 'string'],
            'phone' => ['required', 'digits_between:12,13', 'numeric'],
            'polyclinic_id' => ['required', 'numeric']
        ];
    }
}
