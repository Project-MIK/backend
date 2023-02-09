<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RegistrationOfficersRequest extends Request
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
            "email" => ["required" , "email" , "unique:registration_officers,email"] ,
            "name" => ['required' , 'string'] ,
            "password" => ['required' , 'min:6'],
            "address" => ['required' , 'string'],
            "gender" => ['required']
        ];
    }
}
