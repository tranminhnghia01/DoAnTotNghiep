<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infomation extends Model
{
    use HasFactory;
    public $timestamps =true;

    protected $table ='tbl_infomation';

    protected $fillable =[
        'info_map',
        'info_address',
        'info_email',
        'info_phone',
        'info_fanpage',
    ];

    protected $primaryKey = 'info_id';

    protected $hidden = [
        '_token',
    ];
}
