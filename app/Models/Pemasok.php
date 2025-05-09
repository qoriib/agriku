<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasok extends Model
{
    use HasFactory;

    protected $table = 'pemasoks';

    protected $fillable = [
        'user_id',
        'nama_perusahaan',
        'bahan_baku',
        'no_telp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
