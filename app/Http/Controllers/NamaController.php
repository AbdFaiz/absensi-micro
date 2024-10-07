<?php

namespace App\Http\Controllers;

use App\Models\Nama;
use Illuminate\Http\Request;

class NamaController extends Controller
{
    // Menampilkan list nama (untuk admin)
    public function index()
    {
        $namas = Nama::all();
        return view('namas.index', compact('namas'));
    }

    // Menampilkan form untuk menambahkan nama
    public function create()
    {
        return view('namas.create');
    }

    // Menyimpan nama baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|unique:namas,nama',
        ]);

        $nama = new Nama();
        $nama->nama = $request->nama;
        $nama->save();

        return redirect()->route('namas.index')->with('success', 'Nama berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit nama
    public function edit($id)
    {
        $nama = Nama::findOrFail($id);
        return view('namas.edit', compact('nama'));
    }

    // Menyimpan perubahan nama
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|unique:namas,nama,' . $id,
        ]);

        $nama = Nama::findOrFail($id);
        $nama->nama = $request->nama;
        $nama->save();

        return redirect()->route('namas.index')->with('success', 'Nama berhasil diubah.');
    }

    // Menghapus nama
    public function destroy($id)
    {
        $nama = Nama::findOrFail($id);
        $nama->delete();

        return redirect()->route('namas.index')->with('success', 'Nama berhasil dihapus.');
    }
}
