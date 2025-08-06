<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubAkun extends Model
{
    use HasFactory;

    protected $fillable = ['akun_id', 'kode', 'nama'];
    protected $table = 'sub_akun';
    
    public function akun()
    {
        return $this->belongsTo(Akun::class, 'akun_id', 'id');
    }
}
