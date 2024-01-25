<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HousekeeperRequest extends FormRequest
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
            'name'=>'required',
            'age'=>'required',
            'gender'=>'required',
            'phone'=>'required|max:12',
            'email'=>'required',
            'address'=>'required',
            'image' =>'required|image|mimes:png,jpg|max:2048',
        ];
    }
    public function messages()
    {
        return[
            'required' =>':attribute không được để trống',
            'image' => ':attribute không đúng định dạng',
            'mimes' => ':attribute không đúng định dạng',
            'max' => ':attribute không đúng định dạng',
        ];
    }
    public function attributes()
    {
        return [

            'name'=>'Họ tên',
            'age'=>'Tuổi',
            'gender'=>'Giới tính',
            'des'=>'Mô tả ',
            'phone'=>'Số điện thoại',
            'address'=>'Địa chỉ',
            'image' =>'Hình ảnh'
        ];
    }
}
