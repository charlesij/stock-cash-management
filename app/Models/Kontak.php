<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;
    
    // field "jenis" digunakan untuk membedakan supplier dan customer
    protected $fillable = ['nama', 'alamat', 'no_telp', 'jenis']; 
    protected $table = 'kontak';

}
