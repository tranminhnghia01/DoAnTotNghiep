<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\MailNotify;
use App\Models\Book;

class MailController extends Controller
{
     public function index(Request $request)
    {
            $mailData=[
                'title'=>'Xác nhận đơn hàng',
                'body' => 'This is  for emails demo content',
            ];
            Mail::to('minhnghia11a1@gmail.com')->send(new MailNotify($mailData));
            dd('Email send successfully.');


    }

    public function modal(){
        $book = Book::join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_booking.book_id')
        ->join('tbl_service', 'tbl_service.service_id', '=', 'tbl_booking.service_id')
        ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_booking.shipping_id')
        ->join('tbl_coupon', 'tbl_coupon.coupon_id', '=', 'tbl_booking_details.coupon_id')
        ->join('tbl_payment', 'tbl_payment.payment_id', '=', 'tbl_booking_details.payment_id')
        ->where('tbl_booking.book_id','5455c')->first();

        return view('emails.index')->with(compact('book'));
        Mail::to('minhnghia11a1@gmail.com')->send(new MailNotify($book));

    }
}
