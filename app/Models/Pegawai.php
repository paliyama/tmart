<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pegawai extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'pegawai';
    // list kolom yang bisa diisi
    protected $fillable = ['id_pegawai','nama_pegawai','no_telpon','jenis_kelamin','email_pegawai'];

    // query nilai max dari kode pegawai untuk generate otomatis kode pegawai
    public static function getidpegawai()
    {
        // query kode pegawai
        $sql = "SELECT IFNULL(MAX(id_pegawai), 'PG-000') as id_pegawai 
                FROM pegawai";
        $idpegawai = DB::select($sql);

        // cacah hasilnya
        foreach ($idpegawai as $idpgw) {
            $kd = $idpgw->id_pegawai;
        }
        // Mengambil substring tiga digit akhir dari string PG-000
        $noawal = substr($kd,-3);
        $noakhir = $noawal+1; //menambahkan 1, hasilnya adalah integer cth 1
        
        //menyambung dengan string PG-001
        $noakhir = 'PG-'.str_pad($noakhir,3,"0",STR_PAD_LEFT); 

        return $noakhir;

    }
}
