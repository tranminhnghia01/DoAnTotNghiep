<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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

            'blog_id'=>'required',
            'blog_title'=>'required',
            'blog_content'=>'required',
            'blog_des'=>'required',
            'blog_image'=>'image|mimes:png,jpg|max:2048',
        ];
    }
    public function messages()
    {
        return[
            'required' =>':attribute không được để trống',
        ];
    }
    public function attributes()
    {
        return[
            'blog_title'=>'Tên blog',
            'blog_des'=>'Mô tả',
            'blog_image'=>'Hình ảnh',
        ];
    }
}
