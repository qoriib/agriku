<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormulirPemesananBahanBaku extends Model
{
    protected $table = 'formulir_pemesanan_bahan_baku';

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }

    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class, 'id_pemasok');
    }
}
