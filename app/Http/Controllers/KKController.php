<?php

namespace App\Http\Controllers;

use App\Models\KK;
use Illuminate\Http\Request;

class KKController extends Controller
{
    public function index()
    {
        $kks = KK::withCount('residents')->paginate(15);
        return view('kks.index', compact('kks'));
    }

    public function create()
    {
        return view('kks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_kk' => 'required|unique:kks',
            'alamat' => 'required|string',
            'rt' => 'required|string',
            'rw' => 'required|string',
            'kelurahan' => 'required|string',
            'kecamatan' => 'required|string',
        ]);

        KK::create($validated);

        return redirect()->route('kks.index')->with('success', 'Kartu Keluarga berhasil ditambahkan');
    }

    public function edit(KK $kk)
    {
        return view('kks.edit', compact('kk'));
    }

    public function update(Request $request, KK $kk)
    {
        $validated = $request->validate([
            'no_kk' => 'required|unique:kks,no_kk,' . $kk->id,
            'alamat' => 'required|string',
            'rt' => 'required|string',
            'rw' => 'required|string',
            'kelurahan' => 'required|string',
            'kecamatan' => 'required|string',
        ]);

        $kk->update($validated);

        return redirect()->route('kks.index')->with('success', 'Kartu Keluarga berhasil diperbarui');
    }

    public function destroy(KK $kk)
    {
        $kk->delete();
        return redirect()->route('kks.index')->with('success', 'Kartu Keluarga berhasil dihapus');
    }
}
