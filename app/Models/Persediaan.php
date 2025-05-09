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
        // 'qty_sisa' sengaja tidak dimasukkan agar dihitung otomatis
    ];

    public function barcode()
    {
        return $this->belongsTo(Barcode::class, 'id_barcode');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $latest = self::where('id_barcode', $model->id_barcode)
                ->where('tanggal', '<=', $model->tanggal)
                ->orderByDesc('tanggal')
                ->orderByDesc('id')
                ->first();

            $sisa = $latest?->qty_sisa ?? 0;

            if ($model->tipe === 'masuk') {
                $model->qty_sisa = $sisa + $model->qty_produk;
            } else {
                $model->qty_sisa = max(0, $sisa - $model->qty_produk);
            }
        });
    }
}
