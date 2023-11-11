<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    public $timestamps =true;

    protected $table ='tbl_blog';

    protected $fillable =[
        'blog_id',
        'blog_title',
        'blog_image',
        'blog_des',
        'blog_content',
        'blog_status'
    ];

    protected $primaryKey = 'id';

    protected $hidden = [
        '_token',
    ];
}
