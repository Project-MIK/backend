<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleDetailUpdateRequest extends FormRequest
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
            "consultation_data" => ['sometimes', 'date'],
            "time_start" => ['sometimes', 'date_format:H:i'],
            "time_end" => ['sometimes', 'date_format:H:i'],
            "link" => ['sometimes', 'string'],
            "status" => ['sometimes', 'in:kosong,terisi'],
            "schedule_id" => ['sometimes', 'numeric']
        ];
    }
}
