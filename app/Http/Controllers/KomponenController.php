<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Komponen;
use Illuminate\Http\Request;

class KomponenController extends Controller
{
    public function store(Request $request, Barang $barang)
    {
        $request->validate([
            'jenis_komponen' => 'required|string|max:100',
            'merek'          => 'nullable|string|max:100',
            'spesifikasi'    => 'nullable|string|max:255',
            'kondisi'        => 'required|in:baik,rusak',
            'catatan'        => 'nullable|string|max:500',
        ]);

        Komponen::create([
            'id_barang'      => $barang->id,
            'jenis_komponen' => $request->jenis_komponen,
            'merek'          => $request->merek,
            'spesifikasi'    => $request->spesifikasi,
            'kondisi'        => $request->kondisi,
            'catatan'        => $request->catatan,
        ]);

        return redirect()->route('barang.show', $barang)
            ->with('success', 'Komponen berhasil ditambahkan.');
    }

    public function update(Request $request, Komponen $komponen)
    {
        $request->validate([
            'jenis_komponen' => 'required|string|max:100',
            'merek'          => 'nullable|string|max:100',
            'spesifikasi'    => 'nullable|string|max:255',
            'kondisi'        => 'required|in:baik,rusak',
            'catatan'        => 'nullable|string|max:500',
        ]);

        $komponen->update($request->only([
            'jenis_komponen',
            'merek',
            'spesifikasi',
            'kondisi',
            'catatan'
        ]));

        return redirect()->route('barang.show', $komponen->barang)
            ->with('success', 'Komponen berhasil diupdate.');
    }

    public function destroy(Komponen $komponen)
    {
        $barang = $komponen->barang;
        $komponen->delete();

        return redirect()->route('barang.show', $barang)
            ->with('success', 'Komponen berhasil dihapus.');
    }
}
