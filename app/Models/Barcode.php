<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barcode extends Model
{
    use HasFactory;

    protected $table = 'barcode';

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'satuan',
        'kategori_produk',
        'gudang',
    ];

    public function persediaans()
    {
        return $this->hasMany(Persediaan::class, 'id_barcode');
    }
}
