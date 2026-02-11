<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('roles', 'admin')->get();

        return view('pages.admin.index', [
            'title' => 'Admin - Karyawan App | PT Maju Jaya',
            'active' => 'admin',
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:30',
            'username' => 'required|max:20|unique:users,username',
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

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['roles'] = 'admin';

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            $file->storeAs('avatars', $fileName, 'public');
            $validatedData['avatar'] = $fileName;
        }

        $admin = User::create($validatedData);

        if ($admin) {
            return redirect()->route('admin.index')->with('success', 'Admin berhasil dibuat!');
        } else {
            return redirect()->route('admin.index')->with('error', 'Admin gagal dibuat!');
        }
    }

    public function update(Request $request, User $admin)
    {
        $request->validate([
            'name' => 'required|max:30',
            'username' => [
                'required',
                'max:20',
                Rule::unique('users', 'username')->ignore($admin->id),
            ],
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

        $admin->name = $request->name;
        $admin->username = $request->username;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
            // Hapus file avatar lama jika ada
            if ($admin->avatar) {
                Storage::disk('public')->delete('avatars/' . $admin->avatar);
            }
    
            // Upload and update avatar
            $file = $request->file('avatar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('avatars', $fileName, 'public');
            $admin->avatar = $fileName;
        }

        $admin->save();

        if ($admin) {
            return redirect()->route('admin.index')->with('success', 'Admin berhasil diupdate!');
        } else {
            return redirect()->route('admin.index')->with('error', 'Admin gagal diupdate!');
        }
    }

    public function destroy(User $admin)
    {
        // Hapus file avatar jika ada
        if (!empty($admin->avatar)) {
            Storage::disk('public')->delete('avatars/' . $admin->avatar);
        }

        $admin->delete();

        if ($admin) {
            return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus!');
        } else {
            return redirect()->route('admin.index')->with('error', 'Admin gagal dihapus!');
        }
    }
}
