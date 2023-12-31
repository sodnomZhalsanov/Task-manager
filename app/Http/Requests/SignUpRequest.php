<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class SignUpRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'lastname' => 'required|string|alpha|min:2',
            'firstname' => 'required|string|alpha|min:2',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:8'
        ];
    }

    public function messages()
    {
        return [
            "required" => "Поле :attribute не должно быть пустым.",
            'alpha' => 'Поле :attribute должно содержать только буквы.',
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
            "lastname" => "\"Last Name\"",
            'firstname' => "\"First Name\"",
            "email" => "\"Email\"",
            "password" => "\"Password\""
        ];
    }

}
