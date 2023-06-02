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
            'deadline' => 'required',
            'importance' => 'required|numeric',
            'color' => 'required|string',
            'executor' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            "required" => "Поле :attribute не должно быть пустым.",
            'string' => 'Поле :attribute должен быть строкой.',
            'numeric' => 'Поле :attribute должен быть числом.'

        ];
    }
    public function attributes()
    {
        return [
            'title' => "\"title\"",
            'description' => "\"description\"",
            'deadline' => "\"deadline\"",
            'importance' => "\"importance\"",
            'color' => "\"color\"",
            'executor' => "\"executor\""
        ];
    }

}
