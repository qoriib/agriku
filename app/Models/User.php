<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function karyawan()
    {
        return $this->hasOne(Karyawan::class);
    }

    public function pemasok()
    {
        return $this->hasOne(Pemasok::class);
    }

    public function konsumen()
    {
        return $this->hasOne(Konsumen::class);
    }

    public function getRoleBadge()
    {
        $map = [
            'admin' => ['Admin', 'danger'],
            'kepala_divisi' => ['Kepala Divisi', 'primary'],
            'staf_pengadaan' => ['Staf Pengadaan', 'info'],
            'staf_produksi' => ['Staf Produksi', 'warning'],
            'staf_logistik' => ['Staf Logistik', 'secondary'],
            'pemasok' => ['Pemasok', 'success'],
            'konsumen' => ['Konsumen', 'dark'],
        ];

        $role = $this->role;
        $label = $map[$role][0] ?? ucfirst($role);
        $color = $map[$role][1] ?? 'secondary';

        return '<span class="badge bg-' . $color . '">' . $label . '</span>';
    }
}
