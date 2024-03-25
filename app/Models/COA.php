<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class COA extends Model
{
    use HasFactory;
    protected $table = 'c_o_a_';
    // list kolom yang bisa diisi
    protected $fillable = ['kode_akun','nama_akun','header_akun'];


}

