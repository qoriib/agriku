<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'nip', 'jabatan', 'no_telp', 'alamat'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
