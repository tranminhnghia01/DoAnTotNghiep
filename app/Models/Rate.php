<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;
    public $timestamps =true;

    protected $table ='tbl_rate';

    protected $fillable =[
        'comment_id',
        'user_id',
        'rate',
    ];

    protected $primaryKey = 'id';

    protected $hidden = [
        '_token',
    ];
}
