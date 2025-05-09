<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananBahanBaku extends Model
{
    use HasFactory;

    protected $table = 'pesanan_bahan_baku';

    public function formulirPemesanan()
    {
        return $this->belongsTo(FormulirPemesananBahanBaku::class, 'id_formulir_pemesanan_bahan_baku');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }

    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class, 'id_pemasok');
    }

    public function pembayaranBahanBaku()
    {
        return $this->hasOne(PembayaranBahanBaku::class, 'id_pesanan_bahan_baku');
    }
}
