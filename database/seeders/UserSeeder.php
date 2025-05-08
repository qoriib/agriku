<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use App\Models\Konsumen;
use App\Models\Pemasok;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /// Admin
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin'
        ]);

        // Karyawan
        User::factory(5)->create([
            'role' => 'staf_pengadaan'
        ])->each(function ($user) {
            $user->karyawan()->create(
                Karyawan::factory()->make([
                    'jabatan' => 'staf_pengadaan'
                ])->toArray()
            );
        });

        // Pemasok
        User::factory(3)->create([
            'role' => 'pemasok'
        ])->each(function ($user) {
            $user->pemasok()->create(
                Pemasok::factory()->make()->toArray()
            );
        });

        // Konsumen
        User::factory(5)->create([
            'role' => 'konsumen',
            'password' => bcrypt('konsumen123'),
        ])->each(function ($user) {
            $user->konsumen()->create(
                Konsumen::factory()->make()->toArray()
            );
        });
    }
}
