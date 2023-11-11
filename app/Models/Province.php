<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'province_name', 'province_type', 'city_id'
    ];
    protected $primaryKey = 'province_id';
 	protected $table = 'tbl_province';
}
