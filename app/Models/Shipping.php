<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    protected $table ='tbl_shipping';

    protected $fillable =[
        'user_id',
        'shipping_name',
        'shipping_email',
        'shipping_address',
        'shipping_phone',
        'province_id',
        'ward_id',
        'city_id',
        'shipping_notes',

    ];

    protected $primaryKey = 'id';

    protected $hidden = [
        '_token',
    ];
}
