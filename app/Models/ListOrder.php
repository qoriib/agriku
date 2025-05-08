<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListOrder extends Model
{
    use HasFactory;

    protected $table = 'list_order';

    protected $fillable = [
        'id_pesanan_mako',
        'total_pesanan',
        'status_produksi',
        'status_pengiriman',
    ];

    public function pesananMako()
    {
        return $this->belongsTo(PesananMako::class, 'id_pesanan_mako');
    }
}
