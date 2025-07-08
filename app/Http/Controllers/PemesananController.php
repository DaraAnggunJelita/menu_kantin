<?php

namespace App\Http\Controllers;

use App\Models\DaraPemesanan;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    // ✅ Simpan pesanan dari halaman publik
    public function store(Request $request)
    {
        $request->validate([
            'tipe' => 'required|in:menu,minuman,snack',
            'id' => 'required|integer',
            'jumlah' => 'required|integer|min:1',
            'nama_pemesan' => 'required|string|max:100',
            'no_hp' => 'required|string|max:15',
        ]);

        $data = [
            'jumlah'        => $request->jumlah,
            'nama_pemesan'  => $request->nama_pemesan,
            'no_hp'         => $request->no_hp,
            'status'        => 'pending',
        ];

        // Masukkan ID sesuai tipe (menu, minuman, snack)
        if ($request->tipe === 'menu') {
            $data['menu_id'] = $request->id;
        } elseif ($request->tipe === 'minuman') {
            $data['minuman_id'] = $request->id;
        } elseif ($request->tipe === 'snack') {
            $data['snack_id'] = $request->id;
        }

        DaraPemesanan::create($data);

        return back()->with('success', 'Pesanan berhasil dikirim!');
    }

    // ✅ Tampilkan daftar pesanan di halaman admin
    public function index()
    {
        $pemesanans = DaraPemesanan::latest()->get();
        return view('admin.pemesanan.index', compact('pemesanans'));
    }

    // ✅ Update status pesanan
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai,dibatalkan'
        ]);

        $pesanan = DaraPemesanan::findOrFail($id);
        $pesanan->status = $request->status;
        $pesanan->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
