<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_id'=>'required',
            'product_name'=>'required',
            'product_price'=>'required|numeric',
            'product_des'=>'required',
            'product_content'=>'required',
            'product_qty'=>'required|numeric',
            'product_slug'=>'required',
            'product_tags'=>'required',
            'product_status'=>'required',
            'product_image.*'=>'required|mimes:jpg,jpeg,png,bmp|max:2048',
        ];
    }
}
