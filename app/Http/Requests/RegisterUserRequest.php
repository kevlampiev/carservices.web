<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegisterUserRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'required|string|min:8',
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Name required',
            'name.max' => 'Field Name must be up to 255 characters',
            'email.required' => 'Email required',
            'email.email' => 'Email has a wrong format',
            'email.unique' => 'Пользователь с таким адресом электронной почты уже зарегистрирован в системе',
            'password.required' => 'Password required',
            'password.min' => 'The password is too shot. At least 8 characters required',
        ];
    }
}
