<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	    'coupon_name',
            'coupon_code',
            'coupon_des',
            'coupon_time_start',
            'coupon_time_end',
            'coupon_method',
            'coupon_number',
            'coupon_status',

    ];
    protected $primaryKey = 'coupon_id';
 	protected $table = 'tbl_coupon';
}
