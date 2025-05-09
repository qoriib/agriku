<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranBahanBaku extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_bahan_baku';

    public function pesananBahanBaku()
    {
        return $this->belongsTo(PesananBahanBaku::class, 'id_pesanan_bahan_baku');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
}
