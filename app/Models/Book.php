<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    public $timestamps =true;

    protected $table ='tbl_booking';

    protected $fillable =[
        'book_id',
        'shipping_id',
        'coupon_id',
        'payment_id',
        'service_id',
        'book_address',
        'book_total',
        'book_notes',
        'book_status',
    ];

    protected $primaryKey = 'id';

    protected $hidden = [
        '_token',
    ];
}
