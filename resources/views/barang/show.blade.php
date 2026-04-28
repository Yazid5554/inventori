<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $barang->nama }} — Inventaris</title>
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

    <div class="max-w-7xl mx-auto px-6 py-8">

        {{-- Flash --}}
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

        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('barang.index') }}" class="text-gray-400 hover:text-gray-600">←</a>
            <h1 class="text-2xl font-bold text-gray-900">{{ $barang->nama }}</h1>
        </div>

        <div class="grid grid-cols-3 gap-6">

            {{-- Kolom Kiri: Detail + Riwayat --}}
            <div class="col-span-2 space-y-6">

                {{-- Detail Barang --}}
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h2 class="font-semibold text-gray-900">Detail Barang</h2>
                        <div class="flex gap-2">
                            <a href="{{ route('barang.edit', $barang) }}"
                                class="border border-yellow-300 text-yellow-700 px-3 py-1.5 rounded-lg text-xs hover:bg-yellow-50 transition">Edit</a>
                            <a href="{{ route('barang.print-qr', $barang) }}" target="_blank"
                                class="border border-indigo-300 text-indigo-700 px-3 py-1.5 rounded-lg text-xs hover:bg-indigo-50 transition">
                                🖨️ Print QR
                            </a>
                            <form method="POST" action="{{ route('barang.destroy', $barang) }}"
                                onsubmit="return confirm('Hapus barang ini?')">
                                @csrf @method('DELETE')
                                <button class="border border-red-300 text-red-700 px-3 py-1.5 rounded-lg text-xs hover:bg-red-50 transition">Hapus</button>
                            </form>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-400 text-xs uppercase tracking-wide mb-0.5">Kode Barang</p>
                            <p class="font-mono font-medium">{{ $barang->kode_barang ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs uppercase tracking-wide mb-0.5">Nomor Inventaris</p>
                            <p class="font-mono text-indigo-600">{{ $barang->nomor_inventaris ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs uppercase tracking-wide mb-0.5">Jenis Barang</p>
                            <p>{{ $barang->jenis_barang ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs uppercase tracking-wide mb-0.5">Tanggal Pengadaan</p>
                            <p>
                                @if($barang->tanggal_pengadaan)
                                {{ \Carbon\Carbon::parse($barang->tanggal_pengadaan)->translatedFormat('d F Y') }}
                                @elseif($barang->tahun_pengadaan)
                                {{ $barang->tahun_pengadaan }}
                                @else
                                -
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs uppercase tracking-wide mb-0.5">Ruangan</p>
                            <p>{{ $barang->lokasi?->nama ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs uppercase tracking-wide mb-0.5">Gedung / Lantai</p>
                            <p>{{ $barang->lokasi?->gedung ? strtoupper($barang->lokasi->gedung) : '-' }} / {{ $barang->lokasi?->lantai ?? '-' }}</p>
                        </div>
                        @if($barang->keterangan)
                        <div class="col-span-2">
                            <p class="text-gray-400 text-xs uppercase tracking-wide mb-0.5">Keterangan</p>
                            <p class="text-gray-600">{{ $barang->keterangan }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Form Tambah Kondisi --}}
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                    <h2 class="font-semibold text-gray-900 mb-4">Catat Kondisi Barang</h2>
                    <form method="POST" action="{{ route('kondisi.store', $barang) }}" class="space-y-3">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Kondisi *</label>
                                <select name="kondisi"
                                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                                    <option value="">Pilih kondisi</option>
                                    <option value="baik">✅ Baik</option>
                                    <option value="rusak_ringan">⚠️ Rusak Ringan</option>
                                    <option value="rusak_berat">❌ Rusak Berat</option>
                                    <option value="dalam_perbaikan">🔧 Dalam Perbaikan</option>
                                    <option value="tidak_layak_pakai">🚫 Tidak Layak Pakai</option>
                                </select>
                                @error('kondisi')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Tanggal *</label>
                                <input type="date" name="tanggal_pencatatan"
                                    value="{{ date('Y-m-d') }}"
                                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                                @error('tanggal_pencatatan')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Catatan</label>
                            <textarea name="catatan" rows="2"
                                placeholder="Keterangan kondisi barang..."
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"></textarea>
                        </div>
                        <button type="submit"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition">
                            Simpan Kondisi
                        </button>
                    </form>
                </div>

                {{-- Komponen / Aset Pendukung --}}
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                    <h2 class="font-semibold text-gray-900 mb-4">🔧 Komponen / Aset Pendukung</h2>

                    {{-- Form Tambah Komponen --}}
                    <form method="POST" action="{{ route('komponen.store', $barang) }}" class="mb-6">
                        @csrf
                        <div class="grid grid-cols-2 gap-3 mb-3">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Jenis Komponen *</label>
                                <input type="text" name="jenis_komponen"
                                    placeholder="Remote, RAM, Kabel HDMI, dll"
                                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Kondisi *</label>
                                <select name="kondisi"
                                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                                    <option value="baik">✅ Baik</option>
                                    <option value="rusak">❌ Rusak</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3 mb-3">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Merek</label>
                                <input type="text" name="merek"
                                    placeholder="Corsair, Samsung, Intel, dll"
                                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Spesifikasi</label>
                                <input type="text" name="spesifikasi"
                                    placeholder="16GB DDR4, 256GB NVMe, dll"
                                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-xs font-medium text-gray-600 mb-1">Catatan</label>
                            <input type="text" name="catatan"
                                placeholder="Catatan tambahan..."
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                        </div>
                        <button type="submit"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition">
                            + Tambah Komponen
                        </button>
                    </form>

                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr class="text-left text-xs text-gray-400 uppercase tracking-wide">
                                <th class="px-3 py-2 font-medium">Jenis</th>
                                <th class="px-3 py-2 font-medium">Merek</th>
                                <th class="px-3 py-2 font-medium">Spesifikasi</th>
                                <th class="px-3 py-2 font-medium">Kondisi</th>
                                <th class="px-3 py-2 font-medium">Catatan</th>
                                <th class="px-3 py-2 font-medium">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($barang->komponen as $k)
                            <tr class="hover:bg-gray-50" id="komponen-{{ $k->id }}">
                                <td class="px-3 py-2 font-medium text-gray-900">{{ $k->jenis_komponen }}</td>
                                <td class="px-3 py-2 text-gray-600">{{ $k->merek ?? '-' }}</td>
                                <td class="px-3 py-2 text-gray-600">{{ $k->spesifikasi ?? '-' }}</td>
                                <td class="px-3 py-2">
                                    <span class="px-2 py-0.5 rounded-full text-xs font-medium
                    {{ $k->kondisi === 'baik' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $k->kondisi === 'baik' ? '✅ Baik' : '❌ Rusak' }}
                                    </span>
                                </td>
                                <td class="px-3 py-2 text-gray-500 text-xs">{{ $k->catatan ?? '-' }}</td>
                                <td class="px-3 py-2">
                                    <div class="flex gap-2">
                                        <button onclick="toggleEdit({{ $k->id }})"
                                            class="text-yellow-600 hover:underline text-xs">Edit</button>
                                        <form method="POST" action="{{ route('komponen.destroy', $k) }}"
                                            onsubmit="return confirm('Hapus komponen {{ $k->jenis_komponen }}?')">
                                            @csrf @method('DELETE')
                                            <button class="text-red-500 hover:underline text-xs">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            {{-- Form Edit (hidden) --}}
                            <tr id="edit-{{ $k->id }}" class="hidden bg-indigo-50">
                                <td colspan="6" class="px-3 py-3">
                                    <form method="POST" action="{{ route('komponen.update', $k) }}">
                                        @csrf @method('PATCH')
                                        <div class="grid grid-cols-5 gap-2 mb-2">
                                            <input type="text" name="jenis_komponen" value="{{ $k->jenis_komponen }}"
                                                class="border border-gray-200 rounded-lg px-2 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"
                                                placeholder="Jenis">
                                            <input type="text" name="merek" value="{{ $k->merek }}"
                                                class="border border-gray-200 rounded-lg px-2 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"
                                                placeholder="Merek">
                                            <input type="text" name="spesifikasi" value="{{ $k->spesifikasi }}"
                                                class="border border-gray-200 rounded-lg px-2 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"
                                                placeholder="Spesifikasi">
                                            <select name="kondisi"
                                                class="border border-gray-200 rounded-lg px-2 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                                                <option value="baik" {{ $k->kondisi === 'baik'  ? 'selected' : '' }}>✅ Baik</option>
                                                <option value="rusak" {{ $k->kondisi === 'rusak' ? 'selected' : '' }}>❌ Rusak</option>
                                            </select>
                                            <input type="text" name="catatan" value="{{ $k->catatan }}"
                                                class="border border-gray-200 rounded-lg px-2 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"
                                                placeholder="Catatan">
                                        </div>
                                        <div class="flex gap-2">
                                            <button type="submit"
                                                class="bg-indigo-600 text-white px-3 py-1.5 rounded-lg text-xs hover:bg-indigo-700 transition">
                                                Simpan
                                            </button>
                                            <button type="button" onclick="toggleEdit({{ $k->id }})"
                                                class="bg-gray-200 text-gray-700 px-3 py-1.5 rounded-lg text-xs hover:bg-gray-300 transition">
                                                Batal
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Riwayat Kondisi --}}
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                    <h2 class="font-semibold text-gray-900 mb-4">Riwayat Kondisi</h2>
                    @if($barang->riwayatKondisi->isEmpty())
                    <p class="text-gray-400 text-sm text-center py-4">Belum ada riwayat kondisi.</p>
                    @else
                    <div class="space-y-3">
                        @foreach($barang->riwayatKondisi as $r)
                        <div class="flex items-start justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-start gap-3">
                                <div>
                                    <div class="flex items-center gap-2">
                                        @php
                                        $kondisiConfig = [
                                        'baik' => ['label' => 'Baik', 'class' => 'bg-green-100 text-green-700', 'icon' => '✅'],
                                        'rusak_ringan' => ['label' => 'Rusak Ringan', 'class' => 'bg-yellow-100 text-yellow-700', 'icon' => '⚠️'],
                                        'rusak_berat' => ['label' => 'Rusak Berat', 'class' => 'bg-red-100 text-red-700', 'icon' => '❌'],
                                        'dalam_perbaikan' => ['label' => 'Dalam Perbaikan', 'class' => 'bg-blue-100 text-blue-700', 'icon' => '🔧'],
                                        'tidak_layak_pakai' => ['label' => 'Tidak Layak Pakai', 'class' => 'bg-gray-200 text-gray-700', 'icon' => '🚫'],
                                        ];
                                        $cfg = $kondisiConfig[$r->kondisi] ?? ['label' => $r->kondisi, 'class' => 'bg-gray-100 text-gray-600', 'icon' => '❓'];
                                        @endphp
                                        <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $cfg['class'] }}">
                                            {{ $cfg['icon'] }} {{ $cfg['label'] }}
                                        </span>
                                        <span class="text-xs text-gray-400">
                                            {{ \Carbon\Carbon::parse($r->tanggal_pencatatan)->translatedFormat('d F Y') }}
                                        </span>
                                        <span class="text-xs text-gray-400">
                                            — {{ $r->pengguna?->name ?? 'Unknown' }}
                                        </span>
                                    </div>
                                    @if($r->catatan)
                                    <p class="text-sm text-gray-600 mt-1">{{ $r->catatan }}</p>
                                    @endif
                                </div>
                            </div>
                            <form method="POST" action="{{ route('kondisi.destroy', $r) }}"
                                onsubmit="return confirm('Hapus riwayat ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-400 hover:text-red-600 text-xs">Hapus</button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                {{-- Laporan Kerusakan --}}
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                    <h2 class="font-semibold text-gray-900 mb-4">Laporan Kerusakan</h2>

                    {{-- Form Tambah --}}
                    <form method="POST" action="{{ route('kerusakan.store', $barang) }}" class="space-y-3 mb-6">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Tingkat Kerusakan *</label>
                                <select name="tingkat_kerusakan"
                                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                                    <option value="">Pilih tingkat</option>
                                    <option value="ringan">⚠️ Ringan</option>
                                    <option value="sedang">🔶 Sedang</option>
                                    <option value="parah">🔴 Parah</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Tanggal *</label>
                                <input type="date" name="tanggal_kerusakan" value="{{ date('Y-m-d') }}"
                                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Deskripsi Kerusakan *</label>
                            <textarea name="deskripsi" rows="2"
                                placeholder="Jelaskan kerusakan yang terjadi..."
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"></textarea>
                        </div>
                        <button type="submit"
                            class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-red-700 transition">
                            Laporkan Kerusakan
                        </button>
                    </form>

                    {{-- List Kerusakan --}}
                    @if($barang->kerusakan->isEmpty())
                    <p class="text-gray-400 text-sm text-center py-2">Belum ada laporan kerusakan.</p>
                    @else
                    <div class="space-y-3">
                        @foreach($barang->kerusakan as $k)
                        @php
                        $tingkatConfig = [
                        'ringan' => ['label' => 'Ringan', 'class' => 'bg-yellow-100 text-yellow-700', 'icon' => '⚠️'],
                        'sedang' => ['label' => 'Sedang', 'class' => 'bg-orange-100 text-orange-700', 'icon' => '🔶'],
                        'parah' => ['label' => 'Parah', 'class' => 'bg-red-100 text-red-700', 'icon' => '🔴'],
                        ];
                        $tk = $tingkatConfig[$k->tingkat_kerusakan] ?? ['label' => $k->tingkat_kerusakan, 'class' => 'bg-gray-100 text-gray-600', 'icon' => '❓'];
                        @endphp
                        <div class="flex items-start justify-between p-3 bg-gray-50 rounded-lg">
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $tk['class'] }}">
                                        {{ $tk['icon'] }} {{ $tk['label'] }}
                                    </span>
                                    <span class="text-xs text-gray-400">
                                        {{ \Carbon\Carbon::parse($k->tanggal_kerusakan)->translatedFormat('d F Y') }}
                                    </span>
                                    <span class="text-xs text-gray-400">— {{ $k->pengguna?->name ?? 'Unknown' }}</span>
                                </div>
                                <p class="text-sm text-gray-600">{{ $k->deskripsi }}</p>
                            </div>
                            <form method="POST" action="{{ route('kerusakan.destroy', $k) }}"
                                onsubmit="return confirm('Hapus laporan ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-400 hover:text-red-600 text-xs">Hapus</button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                {{-- Perbaikan --}}
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                    <h2 class="font-semibold text-gray-900 mb-4">Perbaikan</h2>

                    {{-- Form Tambah --}}
                    <form method="POST" action="{{ route('perbaikan.store', $barang) }}" class="space-y-3 mb-6">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Status *</label>
                                <select name="status"
                                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                                    <option value="menunggu">⏳ Menunggu</option>
                                    <option value="sedang_diperbaiki">🔧 Sedang Diperbaiki</option>
                                    <option value="selesai">✅ Selesai</option>
                                    <option value="tidak_bisa_diperbaiki">❌ Tidak Bisa Diperbaiki</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Tanggal *</label>
                                <input type="date" name="tanggal_perbaikan" value="{{ date('Y-m-d') }}"
                                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Deskripsi Kerusakan *</label>
                            <textarea name="deskripsi_kerusakan" rows="2"
                                placeholder="Jelaskan kerusakan yang perlu diperbaiki..."
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"></textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Tindakan</label>
                            <textarea name="tindakan" rows="2"
                                placeholder="Tindakan yang dilakukan..."
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"></textarea>
                        </div>
                        <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                            Catat Perbaikan
                        </button>
                    </form>

                    {{-- List Perbaikan --}}
                    @if($barang->perbaikan->isEmpty())
                    <p class="text-gray-400 text-sm text-center py-2">Belum ada data perbaikan.</p>
                    @else
                    <div class="space-y-3">
                        @foreach($barang->perbaikan as $p)
                        @php
                        $statusConfig = [
                        'menunggu' => ['label' => 'Menunggu', 'class' => 'bg-gray-100 text-gray-700', 'icon' => '⏳'],
                        'sedang_diperbaiki' => ['label' => 'Sedang Diperbaiki', 'class' => 'bg-blue-100 text-blue-700', 'icon' => '🔧'],
                        'selesai' => ['label' => 'Selesai', 'class' => 'bg-green-100 text-green-700', 'icon' => '✅'],
                        'tidak_bisa_diperbaiki'=> ['label' => 'Tidak Bisa Diperbaiki','class' => 'bg-red-100 text-red-700', 'icon' => '❌'],
                        ];
                        $sc = $statusConfig[$p->status] ?? ['label' => $p->status, 'class' => 'bg-gray-100 text-gray-600', 'icon' => '❓'];
                        @endphp
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $sc['class'] }}">
                                            {{ $sc['icon'] }} {{ $sc['label'] }}
                                        </span>
                                        <span class="text-xs text-gray-400">
                                            {{ \Carbon\Carbon::parse($p->tanggal_perbaikan)->translatedFormat('d F Y') }}
                                        </span>
                                        <span class="text-xs text-gray-400">— {{ $p->pengguna?->name ?? 'Unknown' }}</span>
                                    </div>
                                    <p class="text-sm text-gray-600"><span class="font-medium">Kerusakan:</span> {{ $p->deskripsi_kerusakan }}</p>
                                    @if($p->tindakan)
                                    <p class="text-sm text-gray-600 mt-1"><span class="font-medium">Tindakan:</span> {{ $p->tindakan }}</p>
                                    @endif

                                    {{-- Form Update Status --}}
                                    <form method="POST" action="{{ route('perbaikan.update', $p) }}" class="flex gap-2 mt-2">
                                        @csrf @method('PATCH')
                                        <select name="status"
                                            class="border border-gray-200 rounded-lg px-2 py-1 text-xs focus:outline-none focus:ring-2 focus:ring-indigo-300">
                                            @foreach($statusConfig as $val => $cfg)
                                            <option value="{{ $val }}" {{ $p->status === $val ? 'selected' : '' }}>
                                                {{ $cfg['icon'] }} {{ $cfg['label'] }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <button type="submit"
                                            class="bg-indigo-600 text-white px-3 py-1 rounded-lg text-xs hover:bg-indigo-700 transition">
                                            Update Status
                                        </button>
                                    </form>
                                </div>
                                <form method="POST" action="{{ route('perbaikan.destroy', $p) }}"
                                    onsubmit="return confirm('Hapus data perbaikan ini?')" class="ml-2">
                                    @csrf @method('DELETE')
                                    <button class="text-red-400 hover:text-red-600 text-xs">Hapus</button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

            </div>

            {{-- Kolom Kanan: Foto + QR --}}
            <div class="space-y-4">
                @if($barang->foto)
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4">
                    <p class="text-xs text-gray-400 uppercase tracking-wide mb-2">Foto</p>
                    <img src="{{ Storage::url($barang->foto) }}" class="w-full rounded-lg object-cover">
                </div>
                @endif

                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 text-center">
                    <p class="text-xs text-gray-400 uppercase tracking-wide mb-3">QR Code</p>
                    <img src="{{ route('barang.qr', $barang) }}" class="w-40 h-40 mx-auto" alt="QR Code">
                    <a href="{{ route('barang.qr', $barang) }}" target="_blank"
                        class="mt-3 block text-xs text-indigo-600 hover:underline">Download QR</a>
                </div>
            </div>

        </div>
    </div>
</body>

{{-- Tambahkan ini sebelum </body> --}}
<script>
    function toggleEdit(id) {
        const editRow = document.getElementById('edit-' + id);
        editRow.classList.toggle('hidden');
    }
</script>

</html>