<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignInRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|min:8'
        ];
    }

    public function messages()
    {
        return [
            "required" => "Поле :attribute не должно быть пустым.",
            'string' => 'Поле :attribute должен быть строкой.',
            'email' => 'Введите действительный :attribute.',
            'min' => [
                'array' => 'The :attribute must have at least :min items.',
                'file' => 'The :attribute must be at least :min kilobytes.',
                'numeric' => 'The :attribute must be at least :min.',
                'string' => 'Поле :attribute должно быть не короче :min символов.',
            ]
        ];
    }
    public function attributes()
    {
        return [
            "email" => "\"Email\"",
            "password" => "\"Password\""
        ];
    }

}
