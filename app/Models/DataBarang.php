<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBarang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'jenis_barang',
        'harga_barang',
        'stok_barang',
    ];

    public function kelolaBarang()
    {
        return $this->hasMany(KelolaBarang::class, 'kode_barang', 'kode_barang');
    }
}
