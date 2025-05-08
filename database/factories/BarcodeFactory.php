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
            'nama_produk' => $this->faker->randomElement([
                'Beras Premium',
                'Beras Raskin',
                'Pupuk Urea',
                'Benih Jagung',
                'Pakan Ternak',
                'Dedak Halus',
                'Gula Kristal',
                'Minyak Goreng Curah',
                'Karung Plastik',
                'Zat Pengawet',
                'Air Mineral',
                'Bumbu Instan',
                'Kemasan Plastik',
                'Label Cetak',
                'Soda Api',
                'Garam Industri',
            ]),
            'satuan' => $this->faker->randomElement(['kg', 'liter', 'pcs']),
            'kategori_produk' => $this->faker->randomElement(['barang jadi', 'bahan baku', 'bahan pendukung']),
            'gudang' => $this->faker->randomElement(['gudang1', 'gudang2', 'gudang3']),
        ];
    }
}
