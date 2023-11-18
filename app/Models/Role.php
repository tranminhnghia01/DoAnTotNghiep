<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'tbl_role';

    protected $fillable = [
        'role_name'
    ];
    protected $primaryKey = 'role_id';

}
