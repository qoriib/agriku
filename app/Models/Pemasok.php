<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasok extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'nama_perusahaan', 'no_telp', 'alamat'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
