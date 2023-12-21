<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking_details extends Model
{
    use HasFactory;
    protected $table ='tbl_booking_details';

    protected $fillable =[
        'book_id',
        'book_date',
        'book_time_start',
        'book_time_number',
        'book_options',
        'book_total',
    ];

    protected $primaryKey = 'id';

    protected $hidden = [
        '_token',
    ];
}
