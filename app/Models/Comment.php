<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public $timestamps =true;

    protected $table ='tbl_comment';

    protected $fillable =[
        'comment_id',
        'user_id',
        'name',
        'comment',
        'level',
        'image',
    ];

    protected $primaryKey = 'id';

    protected $hidden = [
        '_token',
    ];
}
