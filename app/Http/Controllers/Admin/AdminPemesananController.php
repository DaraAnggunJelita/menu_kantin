<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaraPemesanan;

class AdminPemesananController extends Controller
{
    public function index()
    {
        $pemesanans = DaraPemesanan::latest()->get();
        return view('admin.pemesanan.index', compact('pemesanans'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai',
        ]);

        $pemesanan = DaraPemesanan::findOrFail($id);
        $pemesanan->status = $request->status;
        $pemesanan->save();

        return back()->with('success', 'Status berhasil diperbarui.');
    }
}
