<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaraSnack extends Model
{
    protected $table = 'dara_snacks';

    protected $fillable = [
        'nama_snack',
        'harga',
        'deskripsi',
        'gambar',
        'kategori_id'
    ];

    public function kategori()
    {
        return $this->belongsTo(DaraKategori::class, 'kategori_id');
    }
}
