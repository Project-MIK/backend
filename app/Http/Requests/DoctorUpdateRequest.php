<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorUpdateRequest extends FormRequest
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
            'name' => ['sometimes', 'string'],
            'gender' => ['sometimes', 'in:W,M', 'string'],
            'address' => ['sometimes', 'min:8', 'string'],
            'phone' => ['sometimes', 'digits_between:12,13', 'numeric'],
            'polyclinic_id' => ['sometimes', 'numeric']
        ];
    }
}
