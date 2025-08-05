<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAccess extends Model
{
    protected $fillable = [
        'access_name',
        'access_menu',
        'access_description',
        'access_status',
    ];

    protected $table = 'user_accesses';
}
