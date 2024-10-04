<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelolaBarang extends Model
{
    use HasFactory;

    protected $table = 'kelola_barangs'; // pastikan nama tabel benar

    protected $fillable = ['kode_barang', 'jumlah_masuk', 'jumlah_keluar', 'tanggal_masuk', 'tanggal_keluar'];

    public function dataBarang()
    {
        return $this->belongsTo(DataBarang::class, 'kode_barang', 'kode_barang');
    }
}
