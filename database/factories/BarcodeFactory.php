<?php

namespace Database\Factories;

use App\Models\Barcode;
use Illuminate\Database\Eloquent\Factories\Factory;

class BarcodeFactory extends Factory
{
    protected $model = Barcode::class;

    // Simpan daftar tetap
    protected static array $produkList = [
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
    ];

    public function definition(): array
    {
        // Ambil nama produk secara unik dari daftar
        $nama_produk = array_pop(self::$produkList);

        return [
            'kode_produk' => $this->faker->unique()->numerify('##########'),
            'nama_produk' => $nama_produk ?? $this->faker->unique()->words(2, true),
            'satuan' => $this->faker->randomElement(['Karung (30kg)', 'Karung (50kg)', 'PCS']),
            'kategori_produk' => $this->faker->randomElement(['barang jadi', 'bahan baku', 'bahan pendukung']),
            'gudang' => $this->faker->randomElement(['gudang1', 'gudang2', 'gudang3']),
        ];
    }
}
