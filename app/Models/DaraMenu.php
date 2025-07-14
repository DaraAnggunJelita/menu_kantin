<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaraMenu extends Model
{
    protected $table = 'dara_menus';

    // ✅ Kolom-kolom yang bisa diisi massal (form/form request)
    protected $fillable = [
        'nama_menu',
        'harga',
        'kategori_id',
        'gambar',
    ];

    // ✅ Relasi ke kategori
    public function kategori()
    {
        return $this->belongsTo(DaraKategori::class, 'kategori_id');
    }
}
