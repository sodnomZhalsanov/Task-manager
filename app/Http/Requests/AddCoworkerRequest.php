<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCoworkerRequest extends FormRequest
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
            //
            'task_id.' => 'required',
            'executor_mail' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            "required" => "Поле :attribute не должно быть пустым.",
            'string' => 'Поле :attribute должен быть строкой.'

        ];
    }

    public function attributes()
    {
        return [
            'task_id' => "\"task_id\"",
            'executor_mail' => "\"executor_mail\""
        ];
    }
}
