<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    public $timestamps = true; //set time to false
    protected $fillable = [
    	    'book_id',
            'housekeeper_id',
            'history_status',
            'history_notes',
            'date_finish',
            'history_pevious_date',
            'history_refund',

    ];
    protected $primaryKey ='history_id';
 	protected $table = 'tbl_history';
}
