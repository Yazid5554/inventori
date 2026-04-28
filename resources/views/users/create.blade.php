@extends('layouts.app')
@section('title', 'Tambah User')

@section('content')
<div class="max-w-lg">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('users.index') }}" class="text-gray-400 hover:text-gray-600">←</a>
        <h1 class="text-2xl font-bold text-gray-900">Tambah User</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <form method="POST" action="{{ route('users.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama *</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300 @error('name') border-red-400 @enderror">
                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300 @error('email') border-red-400 @enderror">
                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Role *</label>
                <select name="role" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                    <option value="admin"       {{ old('role') === 'admin'       ? 'selected' : '' }}>Admin</option>
                    <option value="super_admin" {{ old('role') === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password *</label>
                <input type="password" name="password"
                       class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300 @error('password') border-red-400 @enderror">
                @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password *</label>
                <input type="password" name="password_confirmation"
                       class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="bg-indigo-600 text-white px-6 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition">
                    Simpan User
                </button>
                <a href="{{ route('users.index') }}"
                   class="border border-gray-200 text-gray-600 px-6 py-2 rounded-lg text-sm hover:bg-gray-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection