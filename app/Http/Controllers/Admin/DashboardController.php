<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaraMenu;
use App\Models\DaraMinuman;
use App\Models\DaraSnack;
use App\Models\DaraKategori;

class DashboardController extends Controller
{
    public function index($page = 'makanan')
    {
        // Default variabel kosong
        $menus = $minumans = $snacks = $kategoris = [];

        if ($page === 'makanan') {
            $menus = DaraMenu::with('kategori')->get();
            $kategoris = DaraKategori::all();
        } elseif ($page === 'minuman') {
            $minumans = DaraMinuman::all();
        } elseif ($page === 'snack') {
            $snacks = DaraSnack::all();
        } elseif ($page === 'kategori') {
            $kategoris = DaraKategori::all();
        } else {
            abort(404, 'Halaman tidak ditemukan');
        }

        // Kirim data ke view utama dan hanya satu view
        return view('admin.dashboard', compact('page', 'menus', 'minumans', 'snacks', 'kategoris'));
    }
}
