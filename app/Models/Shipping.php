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
        'shipping_image',
        'shipping_email',
        'shipping_address',
        'shipping_phone',
    ];

    protected $primaryKey = 'shipping_id';

    protected $hidden = [
        '_token',
    ];
}
