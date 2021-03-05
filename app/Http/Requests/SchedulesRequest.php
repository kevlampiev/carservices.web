<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchedulesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'work_day' => 'required|date',
            'work_time' => 'required|string',
            'service_id' => 'required|exists:services,id',
            'service_type_id' => 'required|exists:types,id'
        ];
    }
}
