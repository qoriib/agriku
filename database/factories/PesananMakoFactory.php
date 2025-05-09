<?php

namespace Database\Factories;

use App\Models\FormulirPemesananMako;
use App\Models\PesananMako;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PesananMako>
 */
class PesananMakoFactory extends Factory
{
    protected $model = PesananMako::class;

    public function definition(): array
    {
        $formulir = FormulirPemesananMako::inRandomOrder()->first() ?? FormulirPemesananMako::factory()->create();

        return [
            'id_formulir_pemesanan_mako' => $formulir->id,
            'id_konsumen' => $formulir->id_konsumen,
            'status' => $this->faker->randomElement(['menunggu', 'diterima']),
        ];
    }
}
