<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengirimanMako extends Model
{
    use HasFactory;

    protected $table = 'pengiriman_mako';

    protected $fillable = [
        'id_pesanan_mako',
        'id_konsumen',
        'id_karyawan',
        'estimasi_sampai',
        'bukti_pesanan_diterima',
        'status',
    ];

    public function pesananMako()
    {
        return $this->belongsTo(PesananMako::class, 'id_pesanan_mako');
    }

    public function konsumen()
    {
        return $this->belongsTo(Konsumen::class, 'id_konsumen');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
}
