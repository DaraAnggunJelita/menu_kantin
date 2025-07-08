<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaraMinuman extends Model
{
    protected $table = 'dara_minumans';

    protected $fillable = ['nama_minuman', 'harga', 'deskripsi', 'gambar'];
}
