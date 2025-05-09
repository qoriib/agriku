<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class PengirimanBahanBakuFactory extends Factory
{
    public function definition(): array
    {
        $status = $this->faker->randomElement(['dikirim', 'diterima']);
        $bukti = null;

        if ($status === 'diterima') {
            Storage::disk('public')->makeDirectory('bukti_pengiriman_bahan_baku');
            $filename = $this->faker->uuid . '.jpg';
            Storage::disk('public')->put("bukti_pengiriman_bahan_baku/{$filename}", 'dummy content');
            $bukti = "bukti_pengiriman_bahan_baku/{$filename}";
        }

        return [
            'id_pesanan_bahan_baku' => null, // diisi manual di seeder
            'id_pemasok' => null,
            'estimasi_sampai' => $this->faker->dateTimeBetween('+1 days', '+7 days'),
            'bukti_pengiriman' => $bukti,
            'status' => $status,
        ];
    }
}
