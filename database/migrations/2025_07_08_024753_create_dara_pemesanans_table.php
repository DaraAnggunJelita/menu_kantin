<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('dara_pemesanans', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('menu_id')->nullable();     // makanan
        $table->unsignedBigInteger('minuman_id')->nullable();  // minuman
        $table->unsignedBigInteger('snack_id')->nullable();    // snack
        $table->integer('jumlah')->default(1);
        $table->unsignedBigInteger('user_id')->nullable();     // jika login
        $table->string('nama_pemesan');
        $table->string('no_hp');
        $table->enum('status', ['pending', 'proses', 'selesai'])->default('pending');
        $table->timestamps();

        $table->foreign('menu_id')->references('id')->on('dara_menus')->onDelete('set null');
        $table->foreign('minuman_id')->references('id')->on('dara_minumen')->onDelete('set null');
        $table->foreign('snack_id')->references('id')->on('dara_snacks')->onDelete('set null');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dara_pemesanans');
    }
};
