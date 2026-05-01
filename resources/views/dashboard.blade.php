@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<style>
    @keyframes fadeSlideUp {
        0% {
            opacity: 0;
            transform: translateY(30px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .animate-card {
        animation: fadeSlideUp 1.2s cubic-bezier(0.16, 1, 0.3, 1) both;
    }
</style>

{{-- Header --}}
<div class="flex items-center gap-3 mb-4 animate-card" style="animation-delay: 0ms;">
    <svg class="w-8 h-8 text-[#1a2f6e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
    </svg>
    <h1 class="text-3xl font-extrabold text-[#1a2f6e]">Dashboard</h1>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-4 gap-4 mb-4">
    {{-- Total Barang --}}
    <div class="group bg-white rounded-xl border border-gray-100 shadow-sm p-4 relative overflow-hidden flex flex-col justify-between h-[120px] animate-card hover:-translate-y-1.5 hover:shadow-xl hover:border-blue-100 transition-all duration-300" style="animation-delay: 100ms;">
        <div class="flex justify-between items-start">
            <div class="flex gap-5">
                <div class="flex items-center justify-center text-[#2548cc] flex-shrink-0 z-10 mr-2">
                    <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <div class="flex flex-col justify-center z-10">
                    <div class="flex items-center gap-2">
                        <span class="text-[11px] text-gray-500 font-bold uppercase tracking-wider">Total Barang</span>
                        <span class="text-[10px] bg-blue-100 text-blue-600 px-1.5 py-0.5 rounded font-bold">Semua</span>
                    </div>
                    <span class="text-3xl font-extrabold text-gray-900 mt-1 ml-2">{{ $stats['total_barang'] ?? '1,284' }}</span>
                </div>
            </div>
        </div>
        <div class="text-right z-10 mt-auto mb-1.5">
            <a href="{{ route('barang.index') }}" class="text-[10px] font-bold text-blue-500 uppercase tracking-wider hover:text-blue-700 transition-colors inline-flex items-center gap-1">
                Lihat semua barang 
                <svg class="w-3 h-3 group-hover:translate-x-1.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>
        <svg class="w-32 h-32 text-gray-100 absolute -bottom-6 -right-6 z-0 group-hover:scale-125 group-hover:-rotate-6 group-hover:text-blue-50 transition-all duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
        </svg>
    </div>

    {{-- Total Ruangan --}}
    <div class="group bg-white rounded-xl border border-gray-100 shadow-sm p-4 relative overflow-hidden flex flex-col justify-between h-[120px] animate-card hover:-translate-y-1.5 hover:shadow-xl hover:border-green-100 transition-all duration-300" style="animation-delay: 200ms;">
        <div class="flex justify-between items-start">
            <div class="flex gap-5">
                <div class="flex items-center justify-center text-[#2548cc] flex-shrink-0 z-10 mr-2">
                    <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <div class="flex flex-col justify-center z-10">
                    <div class="flex items-center gap-2">
                        <span class="text-[11px] text-gray-500 font-bold uppercase tracking-wider">Total Ruangan</span>
                        <span class="text-[10px] bg-green-100 text-green-600 px-1.5 py-0.5 rounded font-bold">Aktif</span>
                    </div>
                    <span class="text-3xl font-extrabold text-gray-900 mt-1 ml-2">{{ $stats['total_lokasi'] ?? '42' }}</span>
                </div>
            </div>
        </div>
        <div class="text-right z-10 mt-auto mb-1.5">
            <a href="{{ route('lokasi.index') }}" class="text-[10px] font-bold text-blue-500 uppercase tracking-wider hover:text-blue-700 transition-colors inline-flex items-center gap-1">
                Lihat semua ruangan
                <svg class="w-3 h-3 group-hover:translate-x-1.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>
        <svg class="w-32 h-32 text-gray-100 absolute -bottom-6 -right-6 z-0 group-hover:scale-125 group-hover:rotate-6 group-hover:text-green-50 transition-all duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
        </svg>
    </div>

    {{-- Perbaikan Diterima --}}
    <div class="group bg-white rounded-xl border border-gray-100 shadow-sm p-4 relative overflow-hidden flex flex-col justify-between h-[120px] animate-card hover:-translate-y-1.5 hover:shadow-xl hover:border-orange-100 transition-all duration-300" style="animation-delay: 300ms;">
        <div class="flex justify-between items-start">
            <div class="flex gap-5">
                <div class="flex items-center justify-center text-[#2548cc] flex-shrink-0 z-10 mr-2">
                    <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div class="flex flex-col justify-center z-10">
                    <div class="flex items-center gap-2">
                        <span class="text-[11px] text-gray-500 font-bold uppercase tracking-wider">Perbaikan Diterima</span>
                        <span class="text-[10px] bg-orange-100 text-orange-600 px-1.5 py-0.5 rounded font-bold">Baru</span>
                    </div>
                    <span class="text-3xl font-extrabold text-gray-900 mt-1 ml-2">{{ $stats['perbaikan_baru'] ?? '15' }}</span>
                </div>
            </div>
        </div>
        <div class="text-right z-10 mt-auto mb-1.5">
            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider inline-flex items-center gap-1 group-hover:text-gray-500 transition-colors">
                Data Real-time
                <span class="relative flex h-1.5 w-1.5 ml-1">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-orange-500"></span>
                </span>
            </span>
        </div>
        <svg class="w-32 h-32 text-gray-100 absolute -bottom-6 -right-6 z-0 group-hover:scale-125 group-hover:-rotate-6 group-hover:text-orange-50 transition-all duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
        </svg>
    </div>

    {{-- Perbaikan Diproses --}}
    <div class="group bg-white rounded-xl border border-gray-100 shadow-sm p-4 relative overflow-hidden flex flex-col justify-between h-[120px] animate-card hover:-translate-y-1.5 hover:shadow-xl hover:border-purple-100 transition-all duration-300" style="animation-delay: 400ms;">
        <div class="flex justify-between items-start">
            <div class="flex gap-5">
                <div class="flex items-center justify-center text-[#2548cc] flex-shrink-0 z-10 mr-2">
                    <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </div>
                <div class="flex flex-col justify-center z-10">
                    <div class="flex items-center gap-2">
                        <span class="text-[11px] text-gray-500 font-bold uppercase tracking-wider">Perbaikan Diproses</span>
                        <span class="text-[10px] bg-purple-100 text-purple-600 px-1.5 py-0.5 rounded font-bold">Proses</span>
                    </div>
                    <span class="text-3xl font-extrabold text-gray-900 mt-1 ml-2">{{ $stats['perbaikan_aktif'] ?? '08' }}</span>
                </div>
            </div>
        </div>
        <div class="text-right z-10 mt-auto mb-1.5">
            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider inline-flex items-center gap-1 group-hover:text-gray-500 transition-colors">
                Data Real-time
                <span class="relative flex h-1.5 w-1.5 ml-1">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-purple-500"></span>
                </span>
            </span>
        </div>
        <svg class="w-32 h-32 text-gray-100 absolute -bottom-6 -right-6 z-0 group-hover:scale-125 group-hover:rotate-6 group-hover:text-purple-50 transition-all duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
        </svg>
    </div>
</div>

{{-- Tabel Barang Terbaru --}}
<div class="bg-white rounded-xl border border-gray-100 shadow-sm animate-card" style="animation-delay: 500ms;">
    <div class="flex justify-between items-center px-6 py-3 border-b border-gray-100">
        <div>
            <h2 class="font-semibold text-gray-900">Barang Terbaru</h2>
            <p class="text-xs text-gray-400 mt-0.5">Menampilkan daftar inventaris yang baru saja ditambahkan ke sistem.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('barang.create') }}"
                class="bg-[#2548cc] text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-800 hover:-translate-y-0.5 hover:shadow-lg transition-all duration-300 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Barang
            </a>
        </div>
    </div>

    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr class="text-left text-xs text-gray-500 uppercase tracking-wide">
                <th class="px-6 py-2 font-medium">No</th>
                <th class="px-6 py-2 font-medium">Gedung</th>
                <th class="px-6 py-2 font-medium">Lokasi</th>
                <th class="px-6 py-2 font-medium">Tahun</th>
                <th class="px-6 py-2 font-medium">Ruangan</th>
                <th class="px-6 py-2 font-medium">Kode</th>
                <th class="px-6 py-2 font-medium">Nama Barang</th>
                <th class="px-6 py-2 font-medium">Nomor Inventaris</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($barang_terbaru as $i => $b)
            <tr class="hover:bg-blue-50/50 transition-colors duration-200">
                <td class="px-6 py-3 text-gray-400 text-xs">{{ str_pad($b->id ?? $i + 1, 2, '0', STR_PAD_LEFT) }}</td>
                <td class="px-6 py-3">
                    @if($b->lokasi?->gedung)
                    <span class="px-2 py-1 bg-blue-50 text-[#1a2f6e] rounded text-xs font-semibold">
                        Gedung {{ strtoupper($b->lokasi->gedung) }}
                    </span>
                    @else
                    <span class="text-gray-400 text-xs">-</span>
                    @endif
                </td>
                <td class="px-6 py-3 text-gray-600 text-xs">
                    {{ $b->lokasi?->lantai ? 'Lantai ' . $b->lokasi->lantai : '-' }}
                </td>
                <td class="px-6 py-3 text-gray-600">{{ $b->tahun_pengadaan ?? '-' }}</td>
                <td class="px-6 py-3 text-gray-600">{{ $b->lokasi?->nama ?? '-' }}</td>
                <td class="px-6 py-3">
                    <span class="text-[#1a2f6e] font-semibold text-xs">{{ $b->kode_barang ?? '-' }}</span>
                </td>
                <td class="px-6 py-3">
                    <a href="{{ route('barang.show', $b) }}" class="font-medium text-gray-900 hover:text-[#1a2f6e]">
                        {{ $b->nama }}
                    </a>
                </td>
                <td class="px-6 py-3 font-mono text-xs text-gray-500">
                    {{ $b->nomor_inventaris ?? '-' }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="px-6 py-12 text-center text-gray-400">
                    Belum ada barang.
                    <a href="{{ route('barang.create') }}" class="text-[#1a2f6e] hover:underline">Tambah sekarang</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="flex justify-between items-center px-6 py-3 border-t border-gray-100">
        <p class="text-xs text-gray-500">Menampilkan {{ $barang_terbaru->firstItem() ?? 0 }} - {{ $barang_terbaru->lastItem() ?? 0 }} dari {{ $barang_terbaru->total() }} barang</p>
        
        @if ($barang_terbaru->hasPages())
        <div class="flex gap-1">
            {{-- Previous Page Link --}}
            @if ($barang_terbaru->onFirstPage())
                <span class="w-8 h-8 flex items-center justify-center rounded border border-gray-100 text-gray-300 bg-gray-50 cursor-not-allowed">&lt;</span>
            @else
                <a href="{{ $barang_terbaru->previousPageUrl() }}" class="w-8 h-8 flex items-center justify-center rounded border border-gray-200 text-gray-500 hover:bg-gray-50 bg-white shadow-sm">&lt;</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($barang_terbaru->links()->elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="w-8 h-8 flex items-center justify-center rounded border border-gray-100 text-gray-500 bg-white shadow-sm">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $barang_terbaru->currentPage())
                            <span class="w-8 h-8 flex items-center justify-center rounded bg-[#1a2f6e] text-white shadow-sm">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="w-8 h-8 flex items-center justify-center rounded border border-gray-200 text-gray-700 hover:bg-gray-50 bg-white shadow-sm">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($barang_terbaru->hasMorePages())
                <a href="{{ $barang_terbaru->nextPageUrl() }}" class="w-8 h-8 flex items-center justify-center rounded border border-gray-200 text-gray-500 hover:bg-gray-50 bg-white shadow-sm">&gt;</a>
            @else
                <span class="w-8 h-8 flex items-center justify-center rounded border border-gray-100 text-gray-300 bg-gray-50 cursor-not-allowed">&gt;</span>
            @endif
        </div>
        @endif
    </div>
</div>

@endsection