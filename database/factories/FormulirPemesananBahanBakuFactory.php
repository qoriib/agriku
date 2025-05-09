<?php

namespace Database\Factories;

use App\Models\FormulirPemesananBahanBaku;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FormulirPemesananBahanBaku>
 */
class FormulirPemesananBahanBakuFactory extends Factory
{
    protected $model = FormulirPemesananBahanBaku::class;

    public function definition(): array
    {
        return [
            'kode_pemesanan_bahan_baku' => strtoupper($this->faker->bothify('BB##??')),
            'nama_bahan_baku' => $this->faker->randomElement(['Beras', 'Gula', 'Pupuk', 'Garam', 'Jagung']),
            'qty' => $this->faker->numberBetween(10, 100),
            'tanggal_pemesanan' => $this->faker->date(),
            'alamat_pengiriman' => $this->faker->address,
            'harga' => $this->faker->randomFloat(0, 10000, 50000),
            'pajak' => $this->faker->randomFloat(0, 1000, 5000),
            'total_harga' => 0, // akan dihitung ulang di seeder
            'id_karyawan' => null, // diisi saat seeding
            'id_pemasok' => null,  // diisi saat seeding
        ];
    }
}
