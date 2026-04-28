<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Perbaikan;
use Illuminate\Http\Request;

class PerbaikanController extends Controller
{
    public function index()
    {
        $perbaikans = Perbaikan::with(['barang', 'pengguna'])
            ->latest()
            ->paginate(15);

        return view('perbaikan.index', compact('perbaikans'));
    }

    public function store(Request $request, Barang $barang)
    {
        $request->validate([
            'tanggal_perbaikan'  => 'required|date',
            'deskripsi_kerusakan' => 'required|string|max:1000',
            'tindakan'           => 'nullable|string|max:1000',
            'status'             => 'required|in:menunggu,sedang_diperbaiki,selesai,tidak_bisa_diperbaiki',
        ]);

        Perbaikan::create([
            'id_barang'           => $barang->id,
            'id_pengguna'         => auth()->id(),
            'tanggal_perbaikan'   => $request->tanggal_perbaikan,
            'deskripsi_kerusakan' => $request->deskripsi_kerusakan,
            'tindakan'            => $request->tindakan,
            'status'              => $request->status,
        ]);

        return redirect()->route('barang.show', $barang)
            ->with('success', 'Data perbaikan berhasil dicatat.');
    }

    public function update(Request $request, Perbaikan $perbaikan)
    {
        $request->validate([
            'status'   => 'required|in:menunggu,sedang_diperbaiki,selesai,tidak_bisa_diperbaiki',
            'tindakan' => 'nullable|string|max:1000',
        ]);

        $perbaikan->update([
            'status'   => $request->status,
            'tindakan' => $request->tindakan,
        ]);

        return redirect()->route('barang.show', $perbaikan->barang)
            ->with('success', 'Status perbaikan berhasil diupdate.');
    }

    public function destroy(Perbaikan $perbaikan)
    {
        $barang = $perbaikan->barang;
        $perbaikan->delete();

        return redirect()->route('barang.show', $barang)
            ->with('success', 'Data perbaikan berhasil dihapus.');
    }
}
