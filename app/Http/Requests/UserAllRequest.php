<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class UserAllRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'username'      => 'required',
            'phone'         => 'required|numeric',
            'address'       => 'required',
            'sim'           => 'required',
            'role_id'       => 'required'
        ];
    }

}
