<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class RefundRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'car_id'        =>  'required',
            'payment_date'  => 'required'
        ];
    }

}
