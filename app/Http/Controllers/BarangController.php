<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.barang.index', [
            'title' => 'Barang',
            'barangs' => Barang::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'warna' => 'required',
            'ukuran' => 'required',
            'bahan' => 'required',
            'harga' => 'required'
        ]);

        return redirect('/barang')->with('notify', 'Aksi Berhasil.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'warna' => 'required',
            'ukuran' => 'required',
            'bahan' => 'required',
            'harga' => 'required'
        ]);

        $barang->update($validated);

        return redirect('/barang')->with('notify', 'Aksi Berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {

        $barang->delete();

        return redirect('/barang')->with('notify', 'Aksi Berhasil.');
    }
}
