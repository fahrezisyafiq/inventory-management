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
        Schema::create('kelola_barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang'); // Kode barang yang terlibat dalam transaksi
            $table->integer('jumlah_masuk')->nullable(); // Jumlah barang yang masuk
            $table->integer('jumlah_keluar')->nullable(); // Jumlah barang yang keluar
            $table->date('tanggal_masuk')->nullable(); // Tanggal barang masuk
            $table->date('tanggal_keluar')->nullable(); // Tanggal barang keluar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelola_barangs');
    }
};
