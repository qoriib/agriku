<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Persediaan extends Model
{
    use HasFactory;

    protected $table = 'persediaan';

    protected $fillable = [
        'id_barcode',
        'tipe',
        'qty_produk',
        'tanggal',
        'qty_sisa',
    ];

    public function barcode()
    {
        return $this->belongsTo(Barcode::class, 'id_barcode');
    }
}
