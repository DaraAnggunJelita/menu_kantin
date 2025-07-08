<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaraMenu extends Model
{
    protected $table = 'dara_menus';

    protected $fillable = ['kategori_id', 'nama_menu', 'harga', 'deskripsi', 'gambar'];

    public function kategori()
    {
        return $this->belongsTo(DaraKategori::class, 'kategori_id');
    }
}
