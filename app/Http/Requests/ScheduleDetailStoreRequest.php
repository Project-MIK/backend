<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleDetailStoreRequest extends FormRequest
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
            "consultation_date" => ['required', 'date'],
            "time_start" => ['required', 'date_format:H:i:s'],
            "time_end" => ['required', 'date_format:H:i:s'],
            "link" => ['required', 'string'],
            "status" => ['required', 'in:kosong,terisi'],
            "schedule_id" => ['required', 'numeric']
        ];
    }
}
