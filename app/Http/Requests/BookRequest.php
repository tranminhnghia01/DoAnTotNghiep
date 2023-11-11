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
            'book_date'=>'required|date|after:'.now(),
            'book_time_start' => 'required',
            'book_time_end' => 'required',
            'book_s' => 'required',
            'book_notes' => 'required',
            'book_address' => 'required',
        ];
    }

    public function attributes()
    {
        return[
            'book_date'=>'Ngày đặt lịch',
            'book_time_start'=>'Thời gian bắt đầu',
            'book_time_end'=>'Thời gian kết thúc',
            'book_address'=>'Địa chỉ công việc',
        ];
    }
}
