<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'book_date'=>'required',
            'book_time_start' => 'required',
            'book_time_number'=>'required',

        ];
    }

    public function messages()
    {
        return[
            'required' =>'Vui lòng chọn :attribute',
        ];
    }

    public function attributes()
    {
        return[
            'book_date'=>'ngày đặt lịch',
            'book_time_start'=>'thời gian bắt đầu',
            'book_time_number'=>'thời lượng làm việc',
        ];
    }
}
