<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranBahanBaku extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_bahan_baku';

    protected $fillable = [
        'id_pesanan_bahan_baku',
        'id_karyawan',
        'no_rekening_penerima',
        'nama_bank_penerima',
        'nama_pengirim',
        'nama_bank_pengirim',
        'bukti_pembayaran',
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
}
