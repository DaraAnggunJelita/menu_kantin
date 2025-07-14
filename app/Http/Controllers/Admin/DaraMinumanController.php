<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaraMinuman;
use App\Models\DaraKategori;
use Illuminate\Support\Facades\Storage;

class DaraMinumanController extends Controller
{
    // Tampilkan semua minuman
    public function index()
    {
        $minumans = DaraMinuman::with('kategori')->get();
        return view('admin.minuman.index', compact('minumans'));
    }

    // Form tambah minuman
    public function create()
    {
        $kategoris = DaraKategori::all();
        return view('admin.minuman.create', compact('kategoris'));
    }

    // Simpan data minuman baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_minuman'   => 'required|string|max:100',
            'harga'          => 'required|numeric',
            'deskripsi'      => 'nullable|string',
            'kategori_id'    => 'required|exists:dara_kategoris,id',
            'gambar'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['nama_minuman', 'harga', 'deskripsi', 'kategori_id']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('minuman', 'public');
        }

        DaraMinuman::create($data);

        return redirect()->route('admin.dashboard.page', 'minuman')->with('success', 'Minuman berhasil ditambahkan.');
    }

    // Form edit minuman
    public function edit($id)
    {
        $minuman = DaraMinuman::findOrFail($id);
        $kategoris = DaraKategori::all();
        return view('admin.minuman.edit', compact('minuman', 'kategoris'));
    }

    // Update data minuman
    public function update(Request $request, $id)
    {
        $minuman = DaraMinuman::findOrFail($id);

        $request->validate([
            'nama_minuman'   => 'required|string|max:100',
            'harga'          => 'required|numeric',
            'deskripsi'      => 'nullable|string',
            'kategori_id'    => 'required|exists:dara_kategoris,id',
            'gambar'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['nama_minuman', 'harga', 'deskripsi', 'kategori_id']);

        if ($request->hasFile('gambar')) {
            if ($minuman->gambar && Storage::disk('public')->exists($minuman->gambar)) {
                Storage::disk('public')->delete($minuman->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('minuman', 'public');
        }

        $minuman->update($data);

        return redirect()->route('admin.dashboard.page', 'minuman')->with('success', 'Minuman berhasil diperbarui.');
    }

    // Hapus minuman
    public function destroy($id)
    {
        $minuman = DaraMinuman::findOrFail($id);

        if ($minuman->gambar && Storage::disk('public')->exists($minuman->gambar)) {
            Storage::disk('public')->delete($minuman->gambar);
        }

        $minuman->delete();

        return redirect()->route('admin.dashboard.page', 'minuman')->with('success', 'Minuman berhasil dihapus.');
    }

    // Detail minuman
    public function show($id)
    {
        $minuman = DaraMinuman::with('kategori')->findOrFail($id);
        return view('admin.minuman.show', compact('minuman'));
    }
}
