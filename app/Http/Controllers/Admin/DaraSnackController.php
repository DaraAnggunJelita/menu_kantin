<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaraSnack;
use App\Models\DaraKategori;
use Illuminate\Support\Facades\Storage;

class DaraSnackController extends Controller
{
    public function index()
    {
        $snacks = DaraSnack::with('kategori')->get();
        $kategoris = DaraKategori::all();
        return view('admin.snack.index', compact('snacks', 'kategoris'));
    }

    public function create()
    {
        $kategoris = DaraKategori::all();
        return view('admin.snack.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_snack' => 'required|string|max:100',
            'harga' => 'required|numeric',
            'kategori_id' => 'required|exists:dara_kategoris,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['nama_snack', 'harga', 'kategori_id', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('snack', 'public');
        }

        DaraSnack::create($data);

        return redirect()->route('admin.dashboard.page', 'snack')->with('success', 'Snack berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $snack = DaraSnack::findOrFail($id);
        $kategoris = DaraKategori::all();
        return view('admin.snack.edit', compact('snack', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $snack = DaraSnack::findOrFail($id);

        $request->validate([
            'nama_snack' => 'required|string|max:100',
            'harga' => 'required|numeric',
            'kategori_id' => 'required|exists:dara_kategoris,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['nama_snack', 'harga', 'kategori_id', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            if ($snack->gambar && Storage::disk('public')->exists($snack->gambar)) {
                Storage::disk('public')->delete($snack->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('snack', 'public');
        }

        $snack->update($data);

        return redirect()->route('admin.dashboard.page', 'snack')->with('success', 'Snack berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $snack = DaraSnack::findOrFail($id);

        if ($snack->gambar && Storage::disk('public')->exists($snack->gambar)) {
            Storage::disk('public')->delete($snack->gambar);
        }

        $snack->delete();

        return redirect()->route('admin.dashboard.page', 'snack')->with('success', 'Snack berhasil dihapus.');
    }

    public function show($id)
    {
        $snack = DaraSnack::with('kategori')->findOrFail($id);
        return view('admin.snack.show', compact('snack'));
    }
}
