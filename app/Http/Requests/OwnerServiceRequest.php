<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OwnerServiceRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'description' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
            'site' => 'required|string',
            'telegram' => 'required|string',
            'skype' => 'required|string'
        ];
    }
}
