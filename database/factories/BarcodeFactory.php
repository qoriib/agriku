<?php

namespace Database\Factories;

use App\Models\Barcode;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barcode>
 */
class BarcodeFactory extends Factory
{
    protected $model = Barcode::class;

    public function definition(): array
    {
        return [
            'kode_produk' => $this->faker->unique()->numerify('##########'),
            'nama_produk' => $this->faker->word(),
            'satuan' => $this->faker->randomElement(['kg', 'liter', 'pcs']),
            'kategori_produk' => $this->faker->randomElement(['barang jadi', 'bahan baku', 'bahan pendukung']),
            'gudang' => $this->faker->randomElement(['gudang1', 'gudang2', 'gudang3']),
        ];
    }
}
