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
        Schema::create('data_barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang');   // Pastikan ini sesuai dengan kolom yang ingin Anda gunakan
            $table->string('nama_barang');
            $table->string('jenis_barang');
            $table->decimal('harga_barang', 10, 2); // Menggunakan decimal untuk harga
            $table->integer('stok_barang')->default(0); // Atur stok default ke 0
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_barangs');
    }
};
