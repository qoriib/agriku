<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Karyawan;
use App\Models\Pemasok;
use App\Models\Konsumen;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $passwords = [
            'admin' => 'admin123',
            'kepala_divisi' => 'kepala123',
            'staf_pengadaan' => 'pengadaan123',
            'staf_produksi' => 'produksi123',
            'staf_logistik' => 'logistik123',
            'pemasok' => 'pemasok123',
            'konsumen' => 'konsumen123',
        ];

        // === Admin ===
        for ($i = 1; $i <= 2; $i++) {
            User::factory()->create([
                'email' => "admin{$i}@agriku.com",
                'password' => bcrypt($passwords['admin']),
                'role' => 'admin',
            ]);
        }

        // === Karyawan (kepala_divisi, staf_pengadaan, staf_produksi, staf_logistik) ===
        $karyawanRoles = ['kepala_divisi', 'staf_pengadaan', 'staf_produksi', 'staf_logistik'];

        foreach ($karyawanRoles as $role) {
            for ($i = 1; $i <= 2; $i++) {
                $user = User::factory()->create([
                    'email' => "{$role}{$i}@agriku.com",
                    'password' => bcrypt($passwords[$role]),
                    'role' => $role,
                ]);

                $user->karyawan()->create(Karyawan::factory()->make()->toArray());
            }
        }

        // === Pemasok ===
        for ($i = 1; $i <= 2; $i++) {
            $user = User::factory()->create([
                'email' => "pemasok{$i}@agriku.com",
                'password' => bcrypt($passwords['pemasok']),
                'role' => 'pemasok',
            ]);

            $user->pemasok()->create(Pemasok::factory()->make()->toArray());
        }

        // === Konsumen ===
        for ($i = 1; $i <= 2; $i++) {
            $user = User::factory()->create([
                'email' => "konsumen{$i}@agriku.com",
                'password' => bcrypt($passwords['konsumen']),
                'role' => 'konsumen',
            ]);

            $user->konsumen()->create(Konsumen::factory()->make()->toArray());
        }
    }
}
