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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('warna', ['Merah', 'Kuning', 'Hijau', 'Hitam', 'Putih']);
            $table->string('gambar');
            $table->enum('ukuran', ['M', 'L', 'XL']);
            $table->enum('bahan', ['Katun', 'Linen', 'Denim']);
            $table->integer('harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
