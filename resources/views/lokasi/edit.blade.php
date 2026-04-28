<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ruangan — Inventaris</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center h-16">
            <div class="flex items-center gap-8">
                <span class="text-lg font-bold text-indigo-600">📦 Inventaris</span>
                <div class="flex gap-6 text-sm">
                    <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-indigo-600">Dashboard</a>
                    <a href="{{ route('barang.index') }}" class="text-gray-500 hover:text-indigo-600">Barang</a>
                    <a href="{{ route('lokasi.index') }}" class="text-indigo-600 font-medium">Ruangan</a>
                    @if(auth()->user()->role === 'super_admin')
                    <a href="{{ route('users.index') }}" class="text-gray-500 hover:text-indigo-600">Users</a>
                    @endif
                    <a href="{{ route('scan.index') }}" class="text-gray-500 hover:text-indigo-600">Scan QR</a>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-500">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-sm text-red-500 hover:text-red-700">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-lg mx-auto px-6 py-8">
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('lokasi.index') }}" class="text-gray-400 hover:text-gray-600">←</a>
            <h1 class="text-2xl font-bold text-gray-900">Edit Ruangan</h1>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <form method="POST" action="{{ route('lokasi.update', $lokasi) }}" class="space-y-4">
                @csrf @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Ruangan *</label>
                    <input type="text" name="nama" value="{{ old('nama', $lokasi->nama) }}"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300 @error('nama') border-red-400 @enderror">
                    @error('nama')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Gedung</label>
                        <input type="text" name="gedung" value="{{ old('gedung', $lokasi->gedung) }}"
                            placeholder="A, B, C, dll"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Lantai</label>
                        <input type="text" name="lantai" value="{{ old('lantai', $lokasi->lantai) }}"
                            placeholder="01, 02, 03, dll"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis</label>
                    <input type="text" name="jenis" value="{{ old('jenis', $lokasi->jenis) }}"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                    <textarea name="keterangan" rows="3"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">{{ old('keterangan', $lokasi->keterangan) }}</textarea>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                        class="bg-indigo-600 text-white px-6 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition">
                        Update Ruangan
                    </button>
                    <a href="{{ route('lokasi.index') }}"
                        class="border border-gray-200 text-gray-600 px-6 py-2 rounded-lg text-sm hover:bg-gray-50 transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>