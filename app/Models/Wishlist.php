<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'housekeeper_id',
        'shipping_id'
    ];
    protected $primaryKey = 'wishlist_id';
 	protected $table = 'tbl_wishlist';
}
