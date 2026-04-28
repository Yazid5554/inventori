<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Lokasi::withCount('barang');

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('jenis', 'like', '%' . $request->search . '%');
        }

        $lokasis = $query->latest()->paginate(15)->withQueryString();
        return view('lokasi.index', compact('lokasis'));
    }

    public function create()
    {
        return view('lokasi.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'nama'       => 'required|string|max:255|unique:lokasi,nama',
        'gedung'     => 'nullable|string|max:10',
        'lantai'     => 'nullable|string|max:10',
        'jenis'      => 'nullable|string|max:100',
        'keterangan' => 'nullable|string',
    ]);

    Lokasi::create($validated);

    return redirect()->route('lokasi.index')
                     ->with('success', 'Lokasi berhasil ditambahkan.');
}

    public function edit(Lokasi $lokasi)
    {
        return view('lokasi.edit', compact('lokasi'));
    }

    public function update(Request $request, Lokasi $lokasi)
{
    $validated = $request->validate([
        'nama'       => 'required|string|max:255|unique:lokasi,nama,' . $lokasi->id,
        'gedung'     => 'nullable|string|max:10',
        'lantai'     => 'nullable|string|max:10',
        'jenis'      => 'nullable|string|max:100',
        'keterangan' => 'nullable|string',
    ]);

    $lokasi->update($validated);

    return redirect()->route('lokasi.index')
                     ->with('success', 'Lokasi berhasil diupdate.');
}

    public function destroy(Lokasi $lokasi)
    {
        if ($lokasi->barang()->count() > 0) {
            return back()->with('error', 'Lokasi tidak bisa dihapus karena masih ada barang di lokasi ini.');
        }

        $lokasi->delete();
        return redirect()->route('lokasi.index')
                         ->with('success', 'Lokasi berhasil dihapus.');
    }
}