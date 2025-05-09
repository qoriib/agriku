<?php

namespace Database\Factories;

use App\Models\FormulirPemesananMako;
use App\Models\Konsumen;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FormulirPemesananMako>
 */
class FormulirPemesananMakoFactory extends Factory
{
    protected $model = FormulirPemesananMako::class;

    public function definition(): array
    {
        $jenis = $this->faker->randomElement(['raskin', 'premium']);
        $harga = $jenis === 'premium' ? 11000 : 8000;
        $qty = $this->faker->numberBetween(10, 100);
        $total = $qty * $harga;

        return [
            'jenis_mako' => $jenis,
            'qty' => $qty,
            'tanggal_pemesanan' => $this->faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
            'alamat_pengiriman' => $this->faker->address(),
            'harga' => $harga,
            'total_harga' => $total,
            'id_konsumen' => Konsumen::inRandomOrder()->first()?->id ?? Konsumen::factory(), // fallback for seeding
        ];
    }
}
