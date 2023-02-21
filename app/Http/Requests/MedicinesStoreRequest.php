<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicinesStoreRequest extends FormRequest
{
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
            "name" => ['required', "string" , "unique:medicines,name"],
            "price" => ["required" , "numeric"],
            "stock" =>  ["required" , "numeric"],
        ];
    }
}
