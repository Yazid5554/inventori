<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang — Inventaris</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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

    <div class="max-w-7xl mx-auto px-6 py-8">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Daftar Barang</h1>
            <div class="flex gap-2">
                {{-- Dropdown Export --}}
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-700 transition flex items-center gap-2">
                        ⬇ Export
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" @click.outside="open = false"
                        class="absolute right-0 mt-1 w-40 bg-white rounded-lg shadow-lg border border-gray-100 z-10">
                        <a href="{{ route('export.excel') }}"
                            class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 rounded-t-lg">
                            📊 Excel (.xlsx)
                        </a>
                        <a href="{{ route('export.pdf') }}"
                            class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 rounded-b-lg border-t border-gray-100">
                            📄 PDF
                        </a>
                    </div>
                </div>

                <a href="{{ route('barang.print-qr-semua') }}" target="_blank"
                    class="bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-800 transition">
                    🖨️ Print QR
                </a>

                <a href="{{ route('barang.create') }}"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition">
                    + Tambah Barang
                </a>
            </div>
        </div>

        @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3 text-sm mb-4 flex justify-between">
            {{ session('success') }}
            <button onclick="this.parentElement.remove()">×</button>
        </div>
        @endif

        {{-- Filter --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 mb-6">
            <form method="GET" class="flex flex-wrap gap-3 items-end">
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-xs text-gray-500 mb-1">Cari</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Nama, kode, atau nomor inventaris..."
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                </div>
                <div class="w-48">
                    <label class="block text-xs text-gray-500 mb-1">Ruangan</label>
                    <select name="id_lokasi" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                        <option value="">Semua Ruangan</option>
                        @foreach($lokasis as $l)
                        <option value="{{ $l->id }}" {{ request('id_lokasi') == $l->id ? 'selected' : '' }}>
                            {{ $l->nama }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700 transition">
                    Filter
                </button>
                @if(request()->hasAny(['search','id_lokasi']))
                <a href="{{ route('barang.index') }}" class="text-sm text-gray-500 hover:text-gray-700 py-2">Reset</a>
                @endif
            </form>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr class="text-left text-xs text-gray-400 uppercase tracking-wide">
                        <th class="px-4 py-3 font-medium">No</th>
                        <th class="px-4 py-3 font-medium">Gedung</th>
                        <th class="px-4 py-3 font-medium">Lantai</th>
                        <th class="px-4 py-3 font-medium">Tahun</th>
                        <th class="px-4 py-3 font-medium">Ruangan</th>
                        <th class="px-4 py-3 font-medium">Kode</th>
                        <th class="px-4 py-3 font-medium">Nama Barang</th>
                        <th class="px-4 py-3 font-medium">Nomor Inventaris</th>
                        <th class="px-4 py-3 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($barang as $i => $b)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-gray-400 text-xs">
                            {{ ($barang->currentPage() - 1) * $barang->perPage() + $i + 1 }}
                        </td>
                        <td class="px-4 py-3">
                            @if($b->lokasi?->gedung)
                            <span class="px-2 py-1 bg-indigo-50 text-indigo-700 rounded text-xs font-medium">
                                {{ strtoupper($b->lokasi->gedung) }}
                            </span>
                            @else
                            <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-500 text-xs">{{ $b->lokasi?->lantai ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-500 text-xs">{{ $b->tahun_pengadaan ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $b->lokasi?->nama ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs font-mono font-medium">
                                {{ $b->kode_barang ?? '-' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $b->nama }}</td>
                        <td class="px-4 py-3 font-mono text-xs text-indigo-600">
                            {{ $b->nomor_inventaris ?? '-' }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2">
                                <a href="{{ route('barang.show', $b) }}" class="text-indigo-600 hover:underline text-xs">Detail</a>
                                <a href="{{ route('barang.edit', $b) }}" class="text-yellow-600 hover:underline text-xs">Edit</a>
                                <a href="{{ route('barang.qr', $b) }}" target="_blank" class="text-green-600 hover:underline text-xs">QR</a>
                                <form method="POST" action="{{ route('barang.destroy', $b) }}"
                                    onsubmit="return confirm('Hapus {{ $b->nama }}?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-500 hover:underline text-xs">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-4 py-12 text-center text-gray-400">
                            Belum ada barang.
                            <a href="{{ route('barang.create') }}" class="text-indigo-600 hover:underline">Tambah sekarang</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            @if($barang->hasPages())
            <div class="px-4 py-3 border-t border-gray-100">{{ $barang->links() }}</div>
            @endif
        </div>
    </div>
</body>

</html>