<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    // list kolom yang bisa diisi
    protected $fillable = ['kode_produk','nama_produk','merk_produk', 'kategori_produk', 'harga_produk'];

    // query nilai max dari kode produk untuk generate otomatis kode perusahaan
    public static function getKodeProduk()
    {
        // query kode produk
        $sql = "SELECT IFNULL(MAX(kode_produk), 'PR-000') as kode_produk
                FROM produk";
        $kodeproduk = DB::select($sql);

        // cacah hasilnya
        foreach ($kodeproduk as $kdprdk) {
            $kd = $kdprdk->kode_produk;
        }
        // Mengambil substring tiga digit akhir dari string PR-000
        $noawal = substr($kd,-3);
        $noakhir = $noawal+1; //menambahkan 1, hasilnya adalah integer cth 1
        
        //menyambung dengan string PR-001
        $noakhir = 'PR-'.str_pad($noakhir,3,"0",STR_PAD_LEFT); 

        return $noakhir;
}
}
