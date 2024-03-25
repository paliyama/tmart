<?php

namespace App\Http\Controllers;

use App\Models\COA;
use App\Http\Requests\StoreCOARequest;
use App\Http\Requests\UpdateCOARequest;

class COAController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //query data
        $coa = COA::all();
        return view('coa.view',
                    [
                        'coa' => $coa
                    ]
                  );
   }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Isi kode manual
        return view('coa.create', ['kode_akun' => '']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCOARequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'kode_akun' => 'required|unique:c_o_a_|',
            'nama_akun' => 'required|min:0|max:50',
            'header_akun' => 'required|min:0|max:50',
        ]);

        // masukkan ke db
        COA::create($request->all());
        
        return redirect()->route('coa.index')->with('success','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     */
    public function show(COA $coa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(COA $coa)
    {
        return view('coa.edit', compact('coa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCOARequest $request, COA $coa)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'kode_akun' => 'required',
            'nama_akun' => 'required|min:0|max:50',
            'header_akun' => 'required|min:0|max:50',
        ]);
    
        $coa->update($validated);
    
        return redirect()->route('coa.index')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(COA $coa)
    {
        // Delete the COA instance
        $coa->delete();
    
        return redirect()->route('coa.index')->with('success', 'Data Berhasil di Hapus');
    }
    
}
