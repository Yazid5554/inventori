<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Inventaris</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center h-16">
            <div class="flex items-center gap-8">
                <span class="text-lg font-bold text-indigo-600">📦 Inventaris</span>
                <div class="flex gap-6 text-sm">
                    <a href="{{ route('dashboard') }}" class="text-indigo-600 font-medium">Dashboard</a>
                    <a href="{{ route('barang.index') }}" class="text-gray-500 hover:text-indigo-600">Barang</a>
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

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
            <p class="text-gray-500 text-sm mt-1">Selamat datang, {{ auth()->user()->name }}!</p>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Total Barang</p>
                <p class="text-4xl font-bold text-gray-900">{{ $stats['total_barang'] }}</p>
                <a href="{{ route('barang.index') }}" class="text-xs text-indigo-500 hover:underline mt-2 inline-block">Lihat semua →</a>
            </div>
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Total Ruangan</p>
                <p class="text-4xl font-bold text-gray-900">{{ $stats['total_lokasi'] }}</p>
                <a href="{{ route('lokasi.index') }}" class="text-xs text-indigo-500 hover:underline mt-2 inline-block">Lihat semua →</a>
            </div>
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Perbaikan Aktif</p>
                <p class="text-4xl font-bold text-gray-900">{{ $stats['perbaikan_aktif'] }}</p>
            </div>
        </div>

        {{-- Tabel Barang Terbaru --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="font-semibold text-gray-900">Barang Terbaru</h2>
                <a href="{{ route('barang.create') }}"
                    class="bg-indigo-600 text-white px-3 py-1.5 rounded-lg text-xs hover:bg-indigo-700 transition">
                    + Tambah Barang
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100 text-left text-xs text-gray-400 uppercase tracking-wide">
                            <th class="pb-3 font-medium">No</th>
                            <th class="pb-3 font-medium">Gedung</th>
                            <th class="pb-3 font-medium">Lantai</th>
                            <th class="pb-3 font-medium">Tahun</th>
                            <th class="pb-3 font-medium">Ruangan</th>
                            <th class="pb-3 font-medium">Kode</th>
                            <th class="pb-3 font-medium">Nama Barang</th>
                            <th class="pb-3 font-medium">Nomor Inventaris</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($barang_terbaru as $i => $b)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 text-gray-400 text-xs">{{ $i + 1 }}</td>
                            <td class="py-3">
                                @if($b->lokasi?->gedung)
                                <span class="px-2 py-1 bg-indigo-50 text-indigo-700 rounded text-xs font-medium">
                                    {{ strtoupper($b->lokasi->gedung) }}
                                </span>
                                @else
                                <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="py-3 text-gray-500 text-xs">{{ $b->lokasi?->lantai ?? '-' }}</td>
                            <td class="py-3 text-gray-500 text-xs">{{ $b->tahun_pengadaan ?? '-' }}</td>
                            <td class="py-3 text-gray-600">{{ $b->lokasi?->nama ?? '-' }}</td>
                            <td class="py-3">
                                <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs font-mono font-medium">
                                    {{ $b->kode_barang ?? '-' }}
                                </span>
                            </td>
                            <td class="py-3 font-medium text-gray-900">
                                <a href="{{ route('barang.show', $b) }}" class="hover:text-indigo-600">
                                    {{ $b->nama }}
                                </a>
                            </td>
                            <td class="py-3 font-mono text-xs text-indigo-600">
                                {{ $b->nomor_inventaris ?? '-' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="py-8 text-center text-gray-400">
                                Belum ada barang.
                                <a href="{{ route('barang.create') }}" class="text-indigo-600 hover:underline">Tambah sekarang</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($barang_terbaru->isNotEmpty())
            <div class="mt-4 pt-4 border-t border-gray-100">
                <a href="{{ route('barang.index') }}" class="text-sm text-indigo-600 hover:underline">
                    Lihat semua barang →
                </a>
            </div>
            @endif
        </div>
    </div>
</body>

</html>