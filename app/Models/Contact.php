<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    public $timestamps =true;

    protected $table ='tbl_contact';

    protected $fillable =[
        'contact_name',
        'contact_email',
        'contact_subject',
        'contact_content',
        'contact_status',
        'contact_reply',
    ];

    protected $primaryKey = 'id';

    protected $hidden = [
        '_token',
    ];
}
