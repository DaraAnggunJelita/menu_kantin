<?php

namespace App\Http\Controllers;

use App\Models\DaraMenu;
use App\Models\DaraMinuman;
use App\Models\DaraPemesanan;
use App\Models\DaraSnack;
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

        if ($request->tipe == 'menu') {
            $menu = DaraMenu::find($request->id);
            if (!$menu) return back()->with('error', 'Menu tidak ditemukan');
            $data['menu_id'] = $request->id;
        } elseif ($request->tipe == 'minuman') {
            $minuman = DaraMinuman::find($request->id);
            if (!$minuman) return back()->with('error', 'Minuman tidak ditemukan');
            $data['minuman_id'] = $request->id;
        } elseif ($request->tipe == 'snack') {
            $snack = DaraSnack::find($request->id);
            if (!$snack) return back()->with('error', 'Snack tidak ditemukan');
            $data['snack_id'] = $request->id;
        }

        DaraPemesanan::create($data);

        return back()->with('success', 'Pesanan berhasil dikirim!');
    }

    // ✅ Tampilkan daftar pesanan di halaman admin
    public function index()
    {
        $pemesanans = DaraPemesanan::with(['menu', 'minuman', 'snack'])->latest()->get();
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

    // ✅ Cek pesanan untuk pembeli
    public function cekPesananForm(Request $request)
    {
        $pesanans = collect();

        if ($request->filled('nama_pemesan') && $request->filled('no_hp')) {
            $pesanans = DaraPemesanan::with(['menu', 'minuman', 'snack'])
                ->where('nama_pemesan', $request->nama_pemesan)
                ->where('no_hp', $request->no_hp)
                ->latest()
                ->get();
        }

        return view('landing_cek_pesanan', ['pemesanans' => $pesanans]);
    }

    // ✅ Hapus pesanan
    public function destroy($id)
    {
        $pesanan = DaraPemesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->back()->with('success', 'Pesanan berhasil dihapus.');
    }
}
