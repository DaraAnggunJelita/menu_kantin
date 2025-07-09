<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaraMenu extends Model
{
    protected $table = 'dara_menus';

   // App\Models\DaraPemesanan.php
protected $fillable = [
    'menu_id',
    'minuman_id',
    'snack_id',
    'jumlah',
    'nama_pemesan',
    'no_hp',
    'status',
];


    public function kategori()
    {
        return $this->belongsTo(DaraKategori::class, 'kategori_id');
    }
}
