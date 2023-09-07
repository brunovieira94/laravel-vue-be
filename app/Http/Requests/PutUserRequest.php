<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PutUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'max:150',
            'email' => 'email|max:150|unique:users,email,' . $this->id . ',id,deleted_at,NULL',
            'password' => 'max:250|min:8',
        ];
    }
}
