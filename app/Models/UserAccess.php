<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAccess extends Model
{
    protected $table = 'user_accesses';
    protected $fillable = [
        'access_name',
        'access_menu',
        'access_description',
        'access_status',
    ];

}
