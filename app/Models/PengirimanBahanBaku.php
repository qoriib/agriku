<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengirimanBahanBaku extends Model
{
    use HasFactory;

    protected $table = 'pengiriman_bahan_baku';

    protected $fillable = [
        'id_pesanan_bahan_baku',
        'id_karyawan',
        'id_pemasok',
        'bukti_pengiriman',
        'estimasi_sampai',
        'bukti_serah_terima',
        'status',
    ];

    public function pesananBahanBaku()
    {
        return $this->belongsTo(PesananBahanBaku::class, 'id_pesanan_bahan_baku');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }

    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class, 'id_pemasok');
    }
}
