<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:150',
            'email' => 'required|email|max:150|unique:users,email,' . $this->id . ',id,deleted_at,NULL',
            'password' => 'required|max:250|min:8',
        ];
    }
}
