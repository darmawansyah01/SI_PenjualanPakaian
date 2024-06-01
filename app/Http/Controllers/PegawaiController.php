<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\User;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.pegawai.index', [
            'title' => 'Pegawai',
            'pegawais' => Pegawai::with('user')->paginate(10),
            'users' => User::all()
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
            'user_id' => 'required',
            'umur' => 'required'
        ]);

        Pegawai::create($validated);

        return redirect('/pegawai')->with('notify', 'Aksi Berhasil.');
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
    public function update(Request $request, Pegawai $pegawai)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'umur' => 'required'
        ]);

        $pegawai->update($validated);

        return redirect('/pegawai')->with('notify', 'Aksi Berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();
        
        return redirect('/pegawai')->with('notify', 'Aksi Berhasil.');
    }
}
