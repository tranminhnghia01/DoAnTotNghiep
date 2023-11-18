<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Housekeeper extends Model
{
    use HasFactory;
    public $timestamps = true; //set time to false
    protected $fillable = [
    	    'housekeeper_id',
            'name',
            'image',
            'phone',
            'age',
            'gender',
            'address',
            'des',
            'files',
            'status',

    ];
    protected $primaryKey ='id';
 	protected $table = 'tbl_housekeeper';
}
