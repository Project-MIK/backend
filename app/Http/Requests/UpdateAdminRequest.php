<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
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
            "update" => [
                "email" => ["required", "email"],
                "name" => ["required", "string"],
                "address" =>  ["required", "string"],
                "password" => ["required"]
            ],
            "insert" => [
                "email" => ["required", "email"],
                "name" => ["required", "string"],
                "address" =>  ["required", "string"],
                "password" => ["required"]
            ]
        ];
    }
}
