<?php

namespace Database\Seeders;

use App\Models\PembayaranMako;
use App\Models\PesananMako;
use Illuminate\Database\Seeder;

class PembayaranMakoSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $pesanans = PesananMako::where('status', 'diterima')->get();

        foreach ($pesanans as $pesanan) {
            // Skip jika sudah ada pembayaran atau probabilitas 50% untuk dilewati
            if ($pesanan->pembayaranMako || $faker->boolean(50)) {
                continue;
            }

            PembayaranMako::factory()->create([
                'id_pesanan_mako' => $pesanan->id,
                'id_konsumen' => $pesanan->id_konsumen,
            ]);
        }
    }
}
