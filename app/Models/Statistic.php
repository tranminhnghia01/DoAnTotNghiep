<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false

    protected $fillable = [
        'date',
        'sales',
        'profit',
        'total_appointment',
    ];
        protected $primaryKey = 'id_statistical';
        protected $table = 'tbl_statistical';
}
