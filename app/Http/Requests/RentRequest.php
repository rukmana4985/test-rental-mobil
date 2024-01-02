<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class RentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'car_id'  =>  'required',
            'date_start'  =>  'required',
            'date_end' =>  'required',
            // 'price' =>  'required',
            // 'status' =>  'required'
        ];
    }

}
