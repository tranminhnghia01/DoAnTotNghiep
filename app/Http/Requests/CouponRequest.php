<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'coupon_name'=>'required',
            'coupon_code'=>'required',
            'coupon_method'=>'required',
            'coupon_number'=>'required|numeric',
            'coupon_des'=>'required',
            'coupon_content'=>'required',
            'coupon_status'=>'required',
        ];
    }
}
