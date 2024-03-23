<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Http\Requests\StoreprodukRequest;
use App\Http\Requests\UpdateprodukRequest;


class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         //query data
         $produk = produk::all();
         return view('produk.view',
                     [
                         'produk' => $produk
                     ]
                   );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // berikan kode produk secara otomatis
        // 1. query dulu ke db, select max untuk mengetahui posisi terakhir 
        
        return view('produk/create',
                    [
                        'kode_produk' => Produk::getKodeProduk()
                    ]
                  );
        // return view('produk/view');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreprodukRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'kode_produk' => 'required',
            'nama_produk' => 'required|unique:produk|min:5|max:255',
            'merk_produk' => 'required',
            'kategori_produk' => 'required',
            'harga_produk' => 'required',
        ]);

        // masukkan ke db
        Produk::create($request->all());
        
        return redirect()->route('produk.index')->with('success','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateprodukRequest $request, Produk $produk)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'kode_produk' => 'required',
            'nama_produk' => 'required|max:255',
            'merk_produk' => 'required',
            'kategori_produk' => 'required',
            'harga_produk' => 'required',
        ]);
    
        $produk->update($validated);
    
        return redirect()->route('produk.index')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //hapus dari database
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('produk.index')->with('success','Data Berhasil di Hapus');
    }
}
