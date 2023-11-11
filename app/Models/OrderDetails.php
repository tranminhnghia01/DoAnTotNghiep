<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    public $timestamps =true;

    protected $table ='tbl_order_Details';

    protected $fillable =[
        'order_code',
        'product_id',
        'product_price',
        'product_sale',
        'product_sales_qty',
        'product_name',
    ];

    protected $primaryKey = 'order_details_id';

    protected $hidden = [
        '_token',
    ];

    public function product(){
        return $this->belongsTo('App\Product','product_id');
    }
}

