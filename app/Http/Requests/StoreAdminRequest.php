<?php

namespace App\Http\Requests;


use Illuminate\Http\Request;


class StoreAdminRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "email" => ["required", "email" , "unique:admin,email"],
            "name" => ["required" , "string"],
            "address" =>  ["required" , "string"],
            "password" => ["required"]
        ];
    }
}
