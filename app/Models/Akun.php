<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    use HasFactory;

    protected $fillable = ['tipe_akun_id', 'kode', 'nama'];
    protected $table = 'akun';
    
    public function tipeakun()
    {
        return $this->belongsTo(TipeAkun::class, 'tipe_akun_id', 'id');
    }
}
