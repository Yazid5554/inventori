<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar_cropped' => 'required|string',
        ]);

        $user = auth()->user();

        // Decode base64
        $imageData = $request->input('avatar_cropped');
        $imageData = preg_replace('/^data:image\/\w+;base64,/', '', $imageData);
        $imageData = base64_decode($imageData);

        // Hapus avatar lama kalau ada
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Simpan file baru
        $filename = 'avatars/' . uniqid('avatar_') . '.jpg';
        Storage::disk('public')->put($filename, $imageData);

        $user->update(['avatar' => $filename]);

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }
}
