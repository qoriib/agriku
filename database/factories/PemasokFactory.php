<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pemasok>
 */
class PemasokFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_perusahaan' => $this->faker->company(),
            'bahan_baku' => $this->faker->randomElement(['Gula', 'Tepung', 'Beras', 'Garam']),
            'no_telp' => $this->faker->phoneNumber(),
        ];
    }
}
