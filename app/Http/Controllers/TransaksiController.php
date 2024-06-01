<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Barang;

class TransaksiController extends Controller
{
    function index() {
        return view('dashboard.transaksi.index', [
            'title' => 'Transaksi',
            'transaksis' => Transaksi::with('barang.supplier')->paginate(10),
            'barangs' => Barang::all()
        ]);
    }

    function destroy(Transaksi $transaksi) {
        $transaksi->delete();

        return redirect('/transaksi')->with('notify', 'Aksi Berhasil.');
    }

    function store(Request $request) {
        $validated = $request->validate([
            'nama_pembeli' => 'required',
            'barang_id' => 'required',
            'qty' => 'required'
        ]);

        $barang = Barang::where('id', $validated['barang_id'])->first();

        $validated['total_harga'] = $barang->harga * $validated['qty'];

        Transaksi::create($validated);

        return redirect('/transaksi')->with('notify', 'Aksi Berhasil.');
    }
}
