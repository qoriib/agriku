<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormulirPemesananMako extends Model
{
    use HasFactory;

    protected $table = 'formulir_pemesanan_mako';

    protected $fillable = [
        'jenis_mako',
        'qty',
        'tanggal_pemesanan',
        'alamat_pengiriman',
        'harga',
        'total_harga',
        'id_konsumen',
    ];

    public function konsumen()
    {
        return $this->belongsTo(Konsumen::class, 'id_konsumen');
    }

    public function pesananMako()
    {
        return $this->hasOne(PesananMako::class, 'id_formulir_pemesanan_mako');
    }
}
