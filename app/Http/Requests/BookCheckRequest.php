<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookCheckRequest extends FormRequest
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
            'book_time' => 'required',
            'book_notes' => 'required',
            'payment_id' => 'required',
            'book_total' => 'required',
        ];
    }

    public function attributes()
    {
        return[
            'book_date'=>'Ngày đặt lịch',
            'payment_id'=>'Chọn phương thức thanh toán',
            'book_total'=>'Tổng hóa đơn',
        ];
    }
}
