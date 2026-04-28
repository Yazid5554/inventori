<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang — Inventaris</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center h-16">
            <div class="flex items-center gap-8">
                <span class="text-lg font-bold text-indigo-600">📦 Inventaris</span>
                <div class="flex gap-6 text-sm">
                    <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-indigo-600">Dashboard</a>
                    <a href="{{ route('barang.index') }}" class="text-indigo-600 font-medium">Barang</a>
                    <a href="{{ route('lokasi.index') }}" class="text-gray-500 hover:text-indigo-600">Ruangan</a>
                    @if(auth()->user()->role === 'super_admin')
                    <a href="{{ route('users.index') }}" class="text-gray-500 hover:text-indigo-600">Users</a>
                    @endif
                    <a href="{{ route('scan.index') }}" class="text-gray-500 hover:text-indigo-600">Scan QR</a>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-500">{{ auth()->user()->name }}</span>
                <span class="px-2 py-1 text-xs rounded-full
                    {{ auth()->user()->role === 'super_admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                    {{ auth()->user()->role }}
                </span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-sm text-red-500 hover:text-red-700">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-6 py-8">
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('barang.show', $barang) }}" class="text-gray-400 hover:text-gray-600">←</a>
            <h1 class="text-2xl font-bold text-gray-900">Edit Barang</h1>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <form method="POST" action="{{ route('barang.update', $barang) }}" enctype="multipart/form-data" class="space-y-4">
                @csrf @method('PUT')

                {{-- Nama & Kode --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Barang *</label>
                        <input type="text" name="nama" value="{{ old('nama', $barang->nama) }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300 @error('nama') border-red-400 @enderror">
                        @error('nama')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kode Barang *</label>
                        <input type="text" name="kode_barang" value="{{ old('kode_barang', $barang->kode_barang) }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300 @error('kode_barang') border-red-400 @enderror">
                        @error('kode_barang')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- No Inventaris (read only) --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nomor Inventaris
                        <span class="ml-1 text-xs text-indigo-500 font-normal">— otomatis terupdate setelah disimpan</span>
                    </label>
                    <div class="w-full border border-dashed border-gray-300 rounded-lg px-3 py-2 text-sm bg-gray-50 text-gray-600 font-mono">
                        {{ $barang->nomor_inventaris ?? 'Belum digenerate' }}
                    </div>
                </div>

                {{-- Jenis --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Barang</label>
                    <input type="text" name="jenis_barang" value="{{ old('jenis_barang', $barang->jenis_barang) }}"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                </div>

                {{-- Ruangan --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ruangan</label>
                    <select name="id_lokasi"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                        <option value="">Pilih ruangan</option>
                        @foreach($lokasis as $l)
                        <option value="{{ $l->id }}" {{ old('id_lokasi', $barang->id_lokasi) == $l->id ? 'selected' : '' }}>
                            {{ $l->nama }}
                            @if($l->gedung || $l->lantai)
                            (Gd. {{ strtoupper($l->gedung ?? '-') }} / Lt. {{ $l->lantai ?? '-' }})
                            @endif
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tahun & Tanggal --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pengadaan</label>
                        <input type="date" name="tanggal_pengadaan"
                            value="{{ old('tanggal_pengadaan', $barang->tanggal_pengadaan) }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                    </div>
                </div>

                {{-- Keterangan --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                    <textarea name="keterangan" rows="3"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">{{ old('keterangan', $barang->keterangan) }}</textarea>
                </div>

                {{-- Foto --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
                    @if($barang->foto)
                    <div class="mb-2">
                        <img src="{{ Storage::url($barang->foto) }}" class="w-24 h-24 rounded-lg object-cover border">
                        <p class="text-xs text-gray-400 mt-1">Upload baru untuk mengganti.</p>
                    </div>
                    @endif
                    <input type="file" name="foto" accept="image/*"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm">
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                        class="bg-indigo-600 text-white px-6 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition">
                        Update Barang
                    </button>
                    <a href="{{ route('barang.show', $barang) }}"
                        class="border border-gray-200 text-gray-600 px-6 py-2 rounded-lg text-sm hover:bg-gray-50 transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>