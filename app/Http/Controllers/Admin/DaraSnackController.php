<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaraSnack;
use Illuminate\Support\Facades\Storage;

class DaraSnackController extends Controller
{
    public function index()
    {
        $snacks = DaraSnack::all();
        return view('admin.snack.index', compact('snacks'));
    }

    public function create()
    {
        return view('admin.snack.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_snack' => 'required|string|max:100',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['nama_snack', 'harga']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('snack', 'public');
        }

        DaraSnack::create($data);

        return redirect()->route('admin.dashboard.page', 'snack')->with('success', 'Snack berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $snack = DaraSnack::findOrFail($id);
        return view('admin.snack.edit', compact('snack'));
    }

    public function update(Request $request, $id)
    {
        $snack = DaraSnack::findOrFail($id);

        $request->validate([
            'nama_snack' => 'required|string|max:100',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['nama_snack', 'harga']);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($snack->gambar && Storage::disk('public')->exists($snack->gambar)) {
                Storage::disk('public')->delete($snack->gambar);
            }
            // Simpan gambar baru
            $data['gambar'] = $request->file('gambar')->store('snack', 'public');
        }

        $snack->update($data);

        return redirect()->route('admin.dashboard.page', 'snack')->with('success', 'Snack berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $snack = DaraSnack::findOrFail($id);

        // Hapus gambar jika ada
        if ($snack->gambar && Storage::disk('public')->exists($snack->gambar)) {
            Storage::disk('public')->delete($snack->gambar);
        }

        $snack->delete();

        return redirect()->route('admin.dashboard.page', 'snack')->with('success', 'Snack berhasil dihapus.');
    }
    public function show($id)
{
    $snack = DaraSnack::findOrFail($id);
    return view('admin.snack.show', compact('snack'));
}

}
