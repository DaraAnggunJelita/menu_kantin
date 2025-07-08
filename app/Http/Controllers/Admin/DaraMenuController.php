<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaraMenu;
use App\Models\DaraKategori;
use Illuminate\Support\Facades\Storage;

class DaraMenuController extends Controller
{
    public function index()
    {
        $menus = DaraMenu::with('kategori')->get();
        $kategoris = DaraKategori::all();
        return view('admin.menu.index', compact('menus', 'kategoris'));
    }

    public function create()
    {
        $kategoris = DaraKategori::all();
        return view('admin.menu.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:100',
            'harga' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:dara_kategoris,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->only(['nama_menu', 'harga', 'kategori_id']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('menu', 'public');
        }

        DaraMenu::create($data);

        return redirect()->route('admin.dashboard.page', 'makanan')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $menu = DaraMenu::findOrFail($id);
        $kategoris = DaraKategori::all();
        return view('admin.menu.edit', compact('menu', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $menu = DaraMenu::findOrFail($id);

        $request->validate([
            'nama_menu' => 'required|string|max:100',
            'harga' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:dara_kategoris,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->only(['nama_menu', 'harga', 'kategori_id']);

        if ($request->hasFile('gambar')) {
            if ($menu->gambar && Storage::disk('public')->exists($menu->gambar)) {
                Storage::disk('public')->delete($menu->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('menu', 'public');
        }

        $menu->update($data);

        return redirect()->route('admin.dashboard.page', 'makanan')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $menu = DaraMenu::findOrFail($id);

        if ($menu->gambar && Storage::disk('public')->exists($menu->gambar)) {
            Storage::disk('public')->delete($menu->gambar);
        }

        $menu->delete();

        return redirect()->route('admin.dashboard.page', 'makanan')->with('success', 'Menu berhasil dihapus.');
    }
    public function show($id)
{
    $menu = DaraMenu::findOrFail($id);
    return view('admin.menu.show', compact('menu'));
}

}
