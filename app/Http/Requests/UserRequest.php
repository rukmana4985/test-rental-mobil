<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'username'      => 'required',
            'password'      => 'required|min:5|string',
            'role_id'       => 'required',
        ];
    }

}
