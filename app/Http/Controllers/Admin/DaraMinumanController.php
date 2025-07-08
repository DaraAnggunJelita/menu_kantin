<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaraMinuman;
use Illuminate\Support\Facades\Storage;

class DaraMinumanController extends Controller
{
    // Tampilkan semua minuman
    public function index()
    {
        $minumans = DaraMinuman::all();
        return view('admin.minuman.index', compact('minumans'));
    }

    // Form tambah
    public function create()
    {
        return view('admin.minuman.create');
    }

    // Simpan data minuman baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_minuman' => 'required|string|max:100',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['nama_minuman', 'harga', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('minuman', 'public');
        }

        DaraMinuman::create($data);

        return redirect()->route('admin.dashboard.page', 'minuman')->with('success', 'Minuman berhasil ditambahkan.');
    }

    // Tampilkan halaman edit
    public function edit($id)
    {
        $minuman = DaraMinuman::findOrFail($id);
        return view('admin.minuman.edit', compact('minuman'));
    }

    // Update data minuman
    public function update(Request $request, $id)
    {
        $minuman = DaraMinuman::findOrFail($id);

        $request->validate([
            'nama_minuman' => 'required|string|max:100',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['nama_minuman', 'harga', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            if ($minuman->gambar && Storage::disk('public')->exists($minuman->gambar)) {
                Storage::disk('public')->delete($minuman->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('minuman', 'public');
        }

        $minuman->update($data);

        return redirect()->route('admin.dashboard.page', 'minuman')->with('success', 'Minuman berhasil diperbarui.');
    }

    // Hapus data minuman
    public function destroy($id)
    {
        $minuman = DaraMinuman::findOrFail($id);

        if ($minuman->gambar && Storage::disk('public')->exists($minuman->gambar)) {
            Storage::disk('public')->delete($minuman->gambar);
        }

        $minuman->delete();

        return redirect()->route('admin.dashboard.page', 'minuman')->with('success', 'Minuman berhasil dihapus.');
    }

    // ✅ Tampilkan detail minuman
    public function show($id)
    {
        $minuman = DaraMinuman::findOrFail($id);
        return view('admin.minuman.show', compact('minuman'));
    }
}
