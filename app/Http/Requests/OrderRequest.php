<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'name' => 'exists:users,name',
            'car_model' => 'required|string|min:2',
            'license_plate_number' => 'required|string|min:6',
            'description' => 'string',
            'order_status' => 'required|in:in_waiting,confirmed,deny'
        ];
    }
}
