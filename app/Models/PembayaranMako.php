<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranMako extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_mako';

    protected $fillable = [
        'id_pesanan_mako',
        'id_konsumen',
        'no_rekening_penerima',
        'nama_bank_penerima',
        'nama_penerima',
        'cara_pembayaran',
        'nama_pengirim',
        'nama_bank_pengirim',
        'bukti_pembayaran',
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
}