<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    use HasFactory;

    protected $table = 'konsumens';

    protected $fillable = ['user_id', 'no_telp', 'alamat'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
