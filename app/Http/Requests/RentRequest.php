<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'car_id' => 'required|integer',
            'user_id' => 'required|integer'
        ];
    }
}
