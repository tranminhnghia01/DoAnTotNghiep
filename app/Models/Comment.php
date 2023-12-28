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
        'history_id',
        'name',
        'comment',
        'reply',
        'rate',
        'image',
    ];

    protected $primaryKey = 'comment_id';

    protected $hidden = [
        '_token',
    ];
}
