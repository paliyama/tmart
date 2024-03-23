<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Perusahaan extends Model
{
    use HasFactory;
    protected $table = 'perusahaan';
    // list kolom yang bisa diisi
    protected $fillable = ['kode_perusahaan','nama_perusahaan','alamat_perusahaan','no_telpon_perusahaan','email_perusahaan'];

    // query nilai max dari kode perusahaan untuk generate otomatis kode perusahaan
    public static function getKodePerusahaan()
    {
        // query kode perusahaan
        $sql = "SELECT IFNULL(MAX(kode_perusahaan), 'TM-001') as kode_perusahaan 
                FROM perusahaan";
        $kodeperusahaan = DB::select($sql);

        // cacah hasilnya
        foreach ($kodeperusahaan as $kdprsh) {
            $kd = $kdprsh->kode_perusahaan;
        }
        // Mengambil substring tiga digit akhir dari string TM-000
        $noawal = substr($kd,-3);
        $noakhir = $noawal+1; //menambahkan 1, hasilnya adalah integer cth 1
        
        //menyambung dengan string PR-000
        $noakhir = 'TM-'.str_pad($noakhir,3,"0",STR_PAD_LEFT); 

        return $noakhir;

    }
}

