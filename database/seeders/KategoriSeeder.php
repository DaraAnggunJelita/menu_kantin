<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DaraKategori;


class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    DaraKategori::insert([
        ['nama_kategori' => 'Makanan Berat'],
        ['nama_kategori' => 'Minuman'],
        ['nama_kategori' => 'Snack'],
    ]);
}
}
