<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        return view('pages.profile.index', [
            'title' => 'My Profile - Karyawan App | PT Maju Jaya',
            'active' => 'profile',
            'user' => $user,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:30',
            'username' => 'required|max:20|unique:users,username,' . $id,
            'avatar' => 'image|mimes:jpg,jpeg,png,webp|max:5048',
            'password' => 'nullable|min:8|max:255',
        ], [
            'name.max' => 'Nama terlalu panjang, maksimal 30 karakter.',
            'name.required' => 'Nama tidak boleh kosong!',
            'username.required' => 'Username tidak boleh kosong!',
            'username.max' => 'Username terlalu panjang, maksimal 20 karakter.',
            'username.unique' => 'Username sudah digunakan.',
            'avatar.image' => 'Avatar harus berupa gambar.',
            'avatar.mimes' => 'Avatar harus berupa gambar dengan ekstensi .jpg, .jpeg, .png, atau .webp.',
            'avatar.max' => 'Ukuran avatar tidak boleh lebih dari 5MB.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.max' => 'Password maksimal 255 karakter.',
        ]);
    
        // Cek apakah pengguna yang terautentikasi adalah pemilik dari data yang ingin diperbarui
        if (Auth::id() !== (int) $id) {
            return redirect()->route('profile.index')->with('error', 'Oops... Terjadi kesalahan!');
        }
    
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('profile.index')->with('error', 'Pengguna tidak ditemukan!');
        }
    
        $user->name = $request->input('name', $user->name);
        $user->username = $request->input('username', $user->username);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        if ($request->hasFile('avatar')) {
            // Hapus file avatar lama jika ada
            if ($user->avatar) {
                Storage::disk('public')->delete('avatars/' . $user->avatar);
            }
    
            // Upload and update avatar
            $file = $request->file('avatar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('avatars', $fileName, 'public');
            $user->avatar = $fileName;
        }
    
        $user->save();
    
        if ($user) {
            return redirect()->route('profile.index')->with('success', 'Profile berhasil diedit!');
        } else {
            return redirect()->route('profile.index')->with('success', 'Profile gagal diedit!');
        }
    }

    public function deleteAvatar($id)
    {
        // Cek apakah pengguna yang terautentikasi adalah pemilik dari data yang ingin diperbarui
        if (Auth::id() !== (int) $id) {
            return redirect()->route('profile.index')->with('error', 'Oops... Terjadi kesalahan!');
        }
    
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('profile.index')->with('error', 'Pengguna tidak ditemukan!');
        }

        // Hapus file avatar jika ada
        if (!empty($user->avatar)) {
            Storage::disk('public')->delete('avatars/' . $user->avatar);
            $user->avatar = null;
        }

        $user->save();
        
        if ($user) {
            return redirect()->route('profile.index')->with('success', 'Avatar berhasil dihapus!');
        } else {
            return redirect()->route('profile.index')->with('success', 'Avatar gagal dihapus!');
        }
    }
}
