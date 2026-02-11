<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::orderBy('name', 'asc')->get();

        return view('pages.position.index', [
            'title' => 'Pekerjaan - Karyawan App | PT Maju Jaya',
            'active' => 'positions',
            'positions' => $positions
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:positions|max:255',
        ], [
            'name.unique' => 'Nama pekerjaan sudah ada.',
        ]);

        $data = $request->all();

        $position = Position::create($data);

        if ($position) {
            return redirect()->route('position.index')->with('success', 'Nama pekerjaan berhasil dibuat!');
        } else {
            return redirect()->route('position.index')->with('error', 'Nama pekerjaan gagal dibuat!');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:positions|max:255',
        ], [
            'name.unique' => 'Nama pekerjaan sudah ada.',
        ]);
        
        $data = $request->all();
        $position = Position::find($id);

        $position->update($data);

        if ($position) {
            return redirect()->route('position.index')->with('success', 'Nama pekerjaan berhasil diupdate!');
        } else {
            return redirect()->route('position.index')->with('error', 'Nama pekerjaan gagal diupdate!');
        }
    }

    public function destroy($id)
    {
        $position = Position::find($id);

        $position->delete();

        if ($position) {
            return redirect()->route('position.index')->with('success', 'Nama pekerjaan berhasil dihapus!');
        } else {
            return redirect()->route('position.index')->with('error', 'Nama pekerjaan gagal dihapus!');
        }
    }
}
