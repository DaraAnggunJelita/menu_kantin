<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dara_minumans', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_id')->after('id');
            $table->foreign('kategori_id')->references('id')->on('dara_kategoris')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('dara_minumans', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropColumn('kategori_id');
        });
    }
};
