<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kerusakan;
use Illuminate\Http\Request;

class KerusakanController extends Controller
{
    public function store(Request $request, Barang $barang)
    {
        $request->validate([
            'tanggal_kerusakan' => 'required|date',
            'deskripsi'         => 'required|string|max:1000',
            'tingkat_kerusakan' => 'required|in:ringan,sedang,parah',
        ]);

        Kerusakan::create([
            'id_barang'         => $barang->id,
            'id_pengguna'       => auth()->id(),
            'tanggal_kerusakan' => $request->tanggal_kerusakan,
            'deskripsi'         => $request->deskripsi,
            'tingkat_kerusakan' => $request->tingkat_kerusakan,
        ]);

        return redirect()->route('barang.show', $barang)
            ->with('success', 'Laporan kerusakan berhasil dicatat.');
    }

    public function destroy(Kerusakan $kerusakan)
    {
        $barang = $kerusakan->barang;
        $kerusakan->delete();

        return redirect()->route('barang.show', $barang)
            ->with('success', 'Laporan kerusakan berhasil dihapus.');
    }
}
