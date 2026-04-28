@extends('layouts.app')
@section('title', 'Manajemen User')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Manajemen User</h1>
    <a href="{{ route('users.create') }}"
       class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition">
        + Tambah User
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr class="text-left text-gray-500 text-xs uppercase tracking-wide">
                <th class="px-4 py-3 font-medium">Nama</th>
                <th class="px-4 py-3 font-medium">Email</th>
                <th class="px-4 py-3 font-medium">Role</th>
                <th class="px-4 py-3 font-medium">Bergabung</th>
                <th class="px-4 py-3 font-medium">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($users as $user)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-4 py-3 font-medium text-gray-900">
                    {{ $user->name }}
                    @if($user->id === auth()->id())
                    <span class="ml-1 text-xs text-gray-400">(kamu)</span>
                    @endif
                </td>
                <td class="px-4 py-3 text-gray-500">{{ $user->email }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded-full text-xs font-medium
                        {{ $user->role === 'super_admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                        {{ $user->role }}
                    </span>
                </td>
                <td class="px-4 py-3 text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
                <td class="px-4 py-3">
                    <div class="flex gap-2">
                        <a href="{{ route('users.edit', $user) }}" class="text-yellow-600 hover:underline text-xs">Edit</a>
                        @if($user->id !== auth()->id())
                        <form method="POST" action="{{ route('users.destroy', $user) }}"
                              onsubmit="return confirm('Hapus user {{ $user->name }}?')">
                            @csrf @method('DELETE')
                            <button class="text-red-500 hover:underline text-xs">Hapus</button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-4 py-12 text-center text-gray-400">Belum ada user</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($users->hasPages())
    <div class="px-4 py-3 border-t border-gray-100">{{ $users->links() }}</div>
    @endif
</div>
@endsection