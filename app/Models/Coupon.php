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
            'coupon_content',
            'coupon_qty',
            'coupon_status',
            'coupon_method',
            'coupon_number',
    ];
    protected $primaryKey = 'id';
 	protected $table = 'tbl_coupon';
}
