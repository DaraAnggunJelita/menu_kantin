<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaraPemesanan extends Model
{
    // Nama tabel jika tidak sesuai konvensi Laravel
    protected $table = 'dara_pemesanans';

    // Field yang boleh diisi secara mass-assignment (create/update)
    protected $fillable = [
        'menu_id',
        'minuman_id',
        'snack_id',
        'nama_pemesan',
        'no_hp',
        'jumlah',
        'status',
    ];

    // Relasi opsional (jika dibutuhkan)
    public function menu()
    {
        return $this->belongsTo(DaraMenu::class, 'menu_id');
    }

    public function minuman()
    {
        return $this->belongsTo(DaraMinuman::class, 'minuman_id');
    }

    public function snack()
    {
        return $this->belongsTo(DaraSnack::class, 'snack_id');
    }
}
