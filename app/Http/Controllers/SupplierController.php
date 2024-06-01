<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Barang;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.supplier.index', [
            'title' => 'Supplier',
            'suppliers' => Supplier::with('barang')->paginate(10),
            'barangs' => Barang::all()
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
            'barang_id' => 'required',
            'alamat' => 'required',
            'harga' => 'required'
        ]);

        Supplier::create($validated);

        return redirect('/supplier')->with('notify', 'Aksi Berhasil.');
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
    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'barang_id' => 'required',
            'alamat' => 'required',
            'harga' => 'required'
        ]);

        $supplier->update($validated);

        return redirect('/supplier')->with('notify', 'Aksi Berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect('/supplier')->with('notify', 'Aksi Berhasil.');
    }
}
