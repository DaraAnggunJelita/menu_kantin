<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dara_menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_id'); // Relasi ke dara_kategoris
            $table->string('nama_menu');
            $table->integer('harga');
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable(); // Untuk upload gambar
            $table->timestamps();

            // Foreign key ke tabel kategori
            $table->foreign('kategori_id')
                  ->references('id')
                  ->on('dara_kategoris')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dara_menus');
    }
};
