<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('name', 'asc')->get();

        return view('pages.employee.index', [
            'title' => 'Karyawan - Karyawan App | PT Maju Jaya',
            'active' => 'employees',
            'employees' => $employees
        ]);
    }

    public function create()
    {
        $positions = Position::orderBy('name', 'asc')->get();

        return view('pages.employee.create', [
            'title' => 'Tambah Karyawan - Karyawan App | PT Maju Jaya',
            'navTitle' => 'Tambah Karyawan',
            'active' => 'employees',
            'positions' => $positions
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'position' => 'required',
            'email' => 'required|email|unique:employees',
            'phone' => 'required',
            'address' => 'required',
            'status' => 'required|in:active,inactive',
            'avatar' => 'image|mimes:jpg,jpeg,png,webp|max:5048',
            'joined_at' => 'required|date',
        ], [
            'name.required' => 'Nama tidak boleh kosong!',
            'name.max' => 'Nama terlalu panjang, maksimal 30 karakter.',
            'position.required' => 'Posisi tidak boleh kosong!',
            'email.required' => 'Email tidak boleh kosong!',
            'email.unique' => 'Email sudah digunakan.',
            'phone.required' => 'Nomor telepon tidak boleh kosong!',
            'phone.integer' => 'Nomor telepon harus berupa angka.',
            'address.required' => 'Alamat tidak boleh kosong!',
            'status.required' => 'Status tidak boleh kosong!',
            'status.in' => 'Status harus berupa "active" atau "inactive".',
            'avatar.image' => 'Avatar harus berupa gambar.',
            'avatar.mimes' => 'Avatar harus berupa gambar dengan ekstensi .jpg, .jpeg, .png, atau .webp.',
            'avatar.max' => 'Ukuran avatar tidak boleh lebih dari 5MB.',
            'joined_at.required' => 'Tanggal bergabung tidak boleh kosong!',
            'joined_at.date' => 'Tanggal bergabung harus berupa tanggal.',
        ]);

        $data = $request->all();
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            $file->storeAs('avatars', $fileName, 'public');
            $data['avatar'] = $fileName;
        }

        $employee = Employee::create($data);

        if ($employee) {
            return redirect()->route('employee.index')->with('success', 'Karyawan berhasil dibuat!');
        } else {
            return redirect()->route('employee.index')->with('error', 'Karyawan gagal dibuat!');
        }
    }

    public function edit(Employee $employee)
    {
        $positions = Position::orderBy('name', 'asc')->get();

        return view('pages.employee.edit', [
            'title' => 'Edit Karyawan - Karyawan App | PT Maju Jaya',
            'navTitle' => 'Edit Karyawan',
            'active' => 'employees',
            'positions' => $positions,
            'employee' => $employee
        ]);
    }

    public function show(Employee $employee)
    {
        return view('pages.employee.show', [
            'title' => 'Detail Karyawan - Karyawan App | PT Maju Jaya',
            'active' => 'employees',
            'employee' => $employee
        ]);
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'position' => 'required',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('employees')->ignore($employee->id)
            ],
            'phone' => 'required',
            'address' => 'required',
            'status' => 'required|in:active,inactive',
            'avatar' => 'image|mimes:jpg,jpeg,png,webp|max:5048',
            'joined_at' => 'required|date',
        ], [
            'name.required' => 'Nama tidak boleh kosong!',
            'name.max' => 'Nama terlalu panjang, maksimal 30 karakter.',
            'position.required' => 'Posisi tidak boleh kosong!',
            'email.required' => 'Email tidak boleh kosong!',
            'email.unique' => 'Email sudah digunakan.',
            'phone.required' => 'Nomor telepon tidak boleh kosong!',
            'phone.integer' => 'Nomor telepon harus berupa angka.',
            'address.required' => 'Alamat tidak boleh kosong!',
            'status.required' => 'Status tidak boleh kosong!',
            'status.in' => 'Status harus berupa "active" atau "inactive".',
            'avatar.image' => 'Avatar harus berupa gambar.',
            'avatar.mimes' => 'Avatar harus berupa gambar dengan ekstensi .jpg, .jpeg, .png, atau .webp.',
            'avatar.max' => 'Ukuran avatar tidak boleh lebih dari 5MB.',
            'joined_at.required' => 'Tanggal bergabung tidak boleh kosong!',
            'joined_at.date' => 'Tanggal bergabung harus berupa tanggal.',
        ]);

        $data = $request->except('avatar');
        if ($request->hasFile('avatar')) {
            // Hapus file avatar lama jika ada
            if ($employee->avatar) {
                Storage::disk('public')->delete('avatars/' . $employee->avatar);
            }
    
            // Upload and update avatar
            $file = $request->file('avatar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('avatars', $fileName, 'public');
            $data['avatar'] = $fileName;
        }

        $employee->update($data);

        if ($employee) {
            return redirect()->route('employee.index')->with('success', 'Karyawan berhasil diperbarui!');
        } else {
            return redirect()->route('employee.index')->with('error', 'Karyawan gagal diperbarui!');
        }
    }

    public function destroy(Employee $employee)
    {
        // Hapus file avatar jika ada
        if (!empty($employee->avatar)) {
            Storage::disk('public')->delete('avatars/' . $employee->avatar);
        }

        $employee->delete();

        if ($employee) {
            return redirect()->route('employee.index')->with('success', 'Karyawan berhasil dihapus!');
        } else {
            return redirect()->route('employee.index')->with('error', 'Karyawan gagal dihapus!');
        }
    }
}
