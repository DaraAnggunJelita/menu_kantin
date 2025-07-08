<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaraKategori extends Model
{
    protected $table = 'dara_kategoris';

    protected $fillable = ['nama_kategori'];

    public function menus()
    {
        return $this->hasMany(DaraMenu::class, 'kategori_id');
    }
}
