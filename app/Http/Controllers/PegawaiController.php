<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //query data
        $pegawai = Pegawai::all();
        return view('pegawai.view',
                    [
                        'pegawai' => $pegawai
                    ]
                  );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // berikan kode pegawa secara otomatis
        // 1. query dulu ke db, select max untuk mengetahui posisi terakhir 
        
        return view('pegawai/create',
                    [
                        'id_pegawai' => Pegawai::getIdPegawai()
                    ]
                  );
        // return view('pegawai/view');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePegawaiRequest $request)
    {
         //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
         $validated = $request->validate([
            'id_pegawai' => 'required',
            'nama_pegawai' => 'required|unique:pegawai|min:5|max:255',
            'no_telpon' => 'required',
            'jenis_kelamin' => 'required',
            'email_pegawai' => 'required',
        ]);

        // masukkan ke db
        Pegawai::create($request->all());
        
        return redirect()->route('pegawai.index')->with('success','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        return view('pegawai.edit', compact('pegawai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePegawaiRequest $request, Pegawai $pegawai)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'id_pegawai' => 'required',
            'nama_pegawai' => 'required|max:255',
            'no_telpon' => 'required',
            'jenis_kelamin' => 'required',
            'email_pegawai' => 'required',
        ]);
    
        $pegawai->update($validated);
    
        return redirect()->route('pegawai.index')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         //hapus dari database
         $pegawai = Pegawai::findOrFail($id);
         $pegawai->delete();
 
         return redirect()->route('pegawai.index')->with('success','Data Berhasil di Hapus');
     
    }
}
