<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'started_at' => 'date',
            'deadline' => 'date',
            'importance' => 'required|numeric',
            'color' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            "required" => "Поле :attribute не должно быть пустым.",
            'string' => 'Поле :attribute должен быть строкой.',
            'date' => 'Поле :attribute должен быть датой.',
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
            'title' => 'required|string',
            'description' => 'required|string',
            'started_at' => 'date',
            'deadline' => 'date',
            'importance' => 'required|numeric',
            'color' => 'required|string'
        ];
    }

}
