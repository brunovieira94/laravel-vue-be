<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PutTaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'max:150|required',
            'description' => 'max:150|required',
            'status' => 'required|integer|min:0|max:2',
            'date' => 'date'
        ];
    }
}
