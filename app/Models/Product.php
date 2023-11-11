<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
            'category_id',
            'product_id',
    	    'product_name',
            'product_image',
            'product_qty',
            'product_price',
            'product_des',
            'product_status',
            'product_content',
            'product_slug',
            'product_tags',
            'created_at'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'tbl_product';
}
