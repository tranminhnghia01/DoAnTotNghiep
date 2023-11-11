<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps =true;

    protected $table ='tbl_order';

    protected $fillable =[
        'shipping_id',
        'user_id',
        'payment_id',
        'coupon_id',
        'order_total',
        'order_address',
        'order_status',
        'order_notes',
        'order_code',
    ];

    protected $primaryKey = 'order_id';

    protected $hidden = [
        '_token',
    ];
}
