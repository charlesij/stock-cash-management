<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeAkun extends Model
{
    use HasFactory;

    protected $fillable = ['kode', 'nama', 'jenis'];
    protected $table = 'tipe_akun';
    
}
