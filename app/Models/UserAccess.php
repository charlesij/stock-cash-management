<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAccess extends Model
{
    protected $table = 'user_access';
    protected $fillable = [
        'user_id',
        'access_id',
        'created_at',
        'updated_at',
    ];
}
