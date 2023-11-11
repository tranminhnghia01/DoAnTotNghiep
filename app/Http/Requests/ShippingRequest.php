<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingRequest extends FormRequest
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
            'first_name'=>'required',
            'last_name'=>'required',
            'shipping_phone'=>'required|max:12',
            'shipping_email'=>'required',
            'shipping_address'=>'required',
            'city_id'=>'required',
            'province_id'=>'required',
            'ward_id'=>'required',
            'shipping_notes' =>'required'
        ];
    }
}
