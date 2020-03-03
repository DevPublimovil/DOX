<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required|max:255|min:8',
            'email' => [
                'email','required',
                Rule::unique('users', 'email')->ignore($this->user)
                ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'email.required'  => 'El correo es requerido',
            'email.email' => 'El correo debe contener @',
            'email.unique' => 'El correo que ingreso ya esta en uso',
        ];
    }
}
