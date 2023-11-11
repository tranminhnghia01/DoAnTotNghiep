<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    public $timestamps =true;

    protected $table ='tbl_book';

    protected $fillable =[
        'shipping_id',
        'payment_id',
        'coupon_id',
        'book_code',
        'book_address',
        'book_date',
        'book_time_start',
        'book_time_end',
        'book_time_total',
        'book_total',
        'book_status',
        'book_notes',
    ];

    protected $primaryKey = 'book_id';

    protected $hidden = [
        '_token',
    ];
}
