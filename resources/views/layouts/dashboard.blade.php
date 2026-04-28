@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
    <p class="text-gray-500 text-sm mt-1">Selamat datang, {{ auth()->user()->name }}</p>
</div>

{{-- Stats Grid --}}
<div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
    @php
    $cards = [
        ['label' => 'Total Barang',      'value' => $stats['total_barang'],    'color' => 'indigo'],
        ['label' => 'Kondisi Baik',      'value' => $stats['barang_baik'],     'color' => 'green'],
        ['label' => 'Kondisi Rusak',     'value' => $stats['barang_rusak'],    'color' => 'red'],
        ['label' => 'Total Lokasi',      'value' => $stats['total_lokasi'],    'color' => 'yellow'],
        ['label' => 'Perbaikan Aktif',   'value' => $stats['perbaikan_aktif'], 'color' => 'orange'],
    ];
    @endphp
    @foreach($cards as $card)
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
        <p class="text-xs text-gray-500 uppercase tracking-wide">{{ $card['label'] }}</p>
        <p class="text-3xl font-bold text-gray-900 mt-1">{{ $card['value'] }}</p>
    </div>
    @endforeach
</div>

{{-- Barang Terbaru --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-semibold text-gray-900">Barang Terbaru</h2>
        <a href="{{ route('barang.index') }}" class="text-sm text-indigo-600 hover:underline">Lihat semua →</a>
    </div>
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-gray-100 text-left text-gray-500">
                <th class="pb-2 font-medium">Kode</th>
                <th class="pb-2 font-medium">Nama</th>
                <th class="pb-2 font-medium">Lokasi</th>
                <th class="pb-2 font-medium">Kondisi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($barang_terbaru as $b)
            <tr class="hover:bg-gray-50">
                <td class="py-2.5 font-mono text-xs text-gray-500">{{ $b->kode_barang }}</td>
                <td class="py-2.5">
                    <a href="{{ route('barang.show', $b) }}" class="text-indigo-600 hover:underline">
                        {{ $b->nama_barang }}
                    </a>
                </td>
                <td class="py-2.5 text-gray-500">{{ $b->lokasi?->nama_lokasi ?? '-' }}</td>
                <td class="py-2.5">
                    <span class="px-2 py-0.5 rounded-full text-xs font-medium
                        {{ $b->kondisi === 'baik' ? 'bg-green-100 text-green-700' :
                           ($b->kondisi === 'rusak' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                        {{ ucfirst($b->kondisi) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="py-4 text-center text-gray-400">Belum ada barang</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection