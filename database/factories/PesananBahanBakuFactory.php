<?php

namespace Database\Factories;

use App\Models\PesananBahanBaku;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PesananBahanBaku>
 */
class PesananBahanBakuFactory extends Factory
{
    protected $model = PesananBahanBaku::class;

    public function definition(): array
    {
        return [
            'id_formulir_pemesanan_bahan_baku' => null, // akan diisi saat seeding
            'id_karyawan' => null, // akan diisi saat seeding
            'id_pemasok' => null,  // akan diisi saat seeding
            'status' => $this->faker->randomElement(['menunggu', 'diterima']),
        ];
    }
}
