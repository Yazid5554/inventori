<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruangan — Inventaris</title>
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
            <h1 class="text-2xl font-bold text-gray-900">Daftar Ruangan</h1>
            <a href="{{ route('lokasi.create') }}"
                class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition">
                + Tambah Ruangan
            </a>
        </div>

        @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3 text-sm mb-4 flex justify-between">
            {{ session('success') }}
            <button onclick="this.parentElement.remove()">×</button>
        </div>
        @endif
        @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-800 rounded-lg px-4 py-3 text-sm mb-4 flex justify-between">
            {{ session('error') }}
            <button onclick="this.parentElement.remove()">×</button>
        </div>
        @endif

        {{-- Search --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 mb-6">
            <form method="GET" class="flex gap-3">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama ruangan, gedung, atau lantai..."
                    class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700 transition">
                    Cari
                </button>
                @if(request('search'))
                <a href="{{ route('lokasi.index') }}" class="text-sm text-gray-500 hover:text-gray-700 py-2">Reset</a>
                @endif
            </form>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr class="text-left text-xs text-gray-400 uppercase tracking-wide">
                        <th class="px-4 py-3 font-medium">Nama Ruangan</th>
                        <th class="px-4 py-3 font-medium">Gedung</th>
                        <th class="px-4 py-3 font-medium">Lantai</th>
                        <th class="px-4 py-3 font-medium">Jenis</th>
                        <th class="px-4 py-3 font-medium">Keterangan</th>
                        <th class="px-4 py-3 font-medium text-center">Jumlah Barang</th>
                        <th class="px-4 py-3 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($lokasis as $lokasi)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $lokasi->nama }}</td>
                        <td class="px-4 py-3">
                            @if($lokasi->gedung)
                            <span class="px-2 py-1 bg-indigo-50 text-indigo-700 rounded text-xs font-medium">
                                {{ strtoupper($lokasi->gedung) }}
                            </span>
                            @else
                            <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if($lokasi->lantai)
                            <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded text-xs">
                                Lt. {{ $lokasi->lantai }}
                            </span>
                            @else
                            <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if($lokasi->jenis)
                            <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded text-xs">{{ ucfirst($lokasi->jenis) }}</span>
                            @else
                            <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-500 max-w-xs truncate">{{ $lokasi->keterangan ?? '-' }}</td>
                        <td class="px-4 py-3 text-center">
                            <span class="px-2 py-1 bg-indigo-50 text-indigo-700 rounded-full text-xs font-medium">
                                {{ $lokasi->barang_count }} barang
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2">
                                <a href="{{ route('lokasi.edit', $lokasi) }}"
                                    class="text-yellow-600 hover:underline text-xs">Edit</a>
                                <form method="POST" action="{{ route('lokasi.destroy', $lokasi) }}"
                                    onsubmit="return confirm('Hapus ruangan {{ $lokasi->nama }}?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-500 hover:underline text-xs">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-12 text-center text-gray-400">
                            Belum ada ruangan.
                            <a href="{{ route('lokasi.create') }}" class="text-indigo-600 hover:underline">Tambah sekarang</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            @if($lokasis->hasPages())
            <div class="px-4 py-3 border-t border-gray-100">{{ $lokasis->links() }}</div>
            @endif
        </div>
    </div>
</body>

</html>