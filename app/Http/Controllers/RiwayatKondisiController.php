<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\RiwayatKondisi;
use Illuminate\Http\Request;

class RiwayatKondisiController extends Controller
{
    public function store(Request $request, Barang $barang)
    {
        $request->validate([
            'kondisi'            => 'required|in:baik,rusak_ringan,rusak_berat,dalam_perbaikan,tidak_layak_pakai',
            'catatan'            => 'nullable|string|max:500',
            'tanggal_pencatatan' => 'required|date',
        ]);

        RiwayatKondisi::create([
            'id_barang'          => $barang->id,
            'id_pengguna'        => auth()->id(),
            'kondisi'            => $request->kondisi,
            'catatan'            => $request->catatan,
            'tanggal_pencatatan' => $request->tanggal_pencatatan,
        ]);

        return redirect()->route('barang.show', $barang)
            ->with('success', 'Kondisi berhasil dicatat.');
    }

    public function destroy(RiwayatKondisi $riwayatKondisi)
    {
        $barang = $riwayatKondisi->barang;
        $riwayatKondisi->delete();

        return redirect()->route('barang.show', $barang)
            ->with('success', 'Riwayat kondisi berhasil dihapus.');
    }
}
