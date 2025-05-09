<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormulirPemesananBahanBaku extends Model
{
    use HasFactory;

    protected $table = 'formulir_pemesanan_bahan_baku';

    protected $fillable = [
        'kode_pemesanan_bahan_baku',
        'nama_bahan_baku',
        'qty',
        'tanggal_pemesanan',
        'alamat_pengiriman',
        'harga',
        'pajak',
        'total_harga',
        'id_karyawan',
        'id_pemasok',
    ];


    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }

    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class, 'id_pemasok');
    }
}
