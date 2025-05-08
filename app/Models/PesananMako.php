<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananMako extends Model
{
    use HasFactory;

    protected $table = 'pesanan_mako';

    protected $fillable = [
        'id_formulir_pemesanan_mako',
        'id_konsumen',
        'status',
    ];

    public function formulirPemesananMako()
    {
        return $this->belongsTo(FormulirPemesananMako::class, 'id_formulir_pemesanan_mako');
    }

    public function konsumen()
    {
        return $this->belongsTo(Konsumen::class, 'id_konsumen');
    }

    public function pembayaranMako()
    {
        return $this->hasOne(PembayaranMako::class, 'id_pesanan_mako');
    }
}
