<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaraKategori;

class DaraKategoriController extends Controller
{
    public function index()
    {
        $kategoris = DaraKategori::all();
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
        ]);

        DaraKategori::create($request->only('nama_kategori'));

        return redirect()->route('admin.dashboard.page', 'kategori')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategori = DaraKategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
        ]);

        $kategori = DaraKategori::findOrFail($id);
        $kategori->update($request->only('nama_kategori'));

        return redirect()->route('admin.dashboard.page', 'kategori')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = DaraKategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('admin.dashboard.page', 'kategori')->with('success', 'Kategori berhasil dihapus.');
    }
}
