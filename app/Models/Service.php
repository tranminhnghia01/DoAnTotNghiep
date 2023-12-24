<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'tbl_service';

    protected $fillable = [
        'service_name',
        'service_image',
        'service_des',
        'service_slug',
        'service_price',
        'service_content',
        'service_status',
    ];
    protected $primaryKey = 'service_id';

}
