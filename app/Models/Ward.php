<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'ward_name', 'ward_type', 'province_id'
    ];
    protected $primaryKey = 'ward_id';
 	protected $table = 'tbl_ward';
}
