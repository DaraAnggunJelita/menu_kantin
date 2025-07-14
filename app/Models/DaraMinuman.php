<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaraMinuman extends Model
{
    protected $table = 'dara_minumans';

    protected $fillable = [
        'nama_minuman',
        'harga',
        'deskripsi',
        'gambar',
        'kategori_id', // ✅ pastikan ada
    ];

    // ✅ Relasi ke tabel kategori
    public function kategori()
    {
        return $this->belongsTo(DaraKategori::class, 'kategori_id');
    }
}
