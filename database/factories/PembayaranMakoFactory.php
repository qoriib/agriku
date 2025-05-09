<?php

namespace Database\Factories;

use App\Models\PembayaranMako;
use App\Models\PesananMako;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PembayaranMako>
 */
class PembayaranMakoFactory extends Factory
{
    protected $model = PembayaranMako::class;

    public function definition(): array
    {
        return [
            'id_pesanan_mako' => PesananMako::factory(), // opsional: akan ditimpa di seeder
            'id_konsumen' => null, // akan di-set manual di seeder
            'no_rekening_penerima' => $this->faker->bankAccountNumber,
            'nama_bank_penerima' => $this->faker->randomElement(['BRI', 'BCA', 'BNI', 'Mandiri']),
            'nama_penerima' => $this->faker->name,
            'cara_pembayaran' => $this->faker->randomElement(['transfer', 'tunai']),
            'nama_pengirim' => $this->faker->name,
            'nama_bank_pengirim' => $this->faker->randomElement(['BRI', 'BCA', 'BNI', 'Mandiri']),
            'bukti_pembayaran' => 'bukti_pembayaran/sample.jpg',
            'status' => $this->faker->randomElement(['menunggu pembayaran', 'lunas']),
        ];
    }
}
