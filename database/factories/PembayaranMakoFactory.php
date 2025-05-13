<?php

namespace Database\Factories;

use App\Models\PembayaranMako;
use App\Models\PesananMako;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PembayaranMako>
 */
class PembayaranMakoFactory extends Factory
{
    protected $model = PembayaranMako::class;

    public function definition(): array
    {
        // Tentukan folder penyimpanan
        $folder = 'bukti_pembayaran_mako';
        Storage::disk('public')->makeDirectory($folder);

        // Generate nama file unik
        $filename = $this->faker->uuid . '.png';
        $path = "$folder/$filename";

        // Salin file sample.png ke storage
        $source = public_path('images/sample.png');
        if (file_exists($source)) {
            Storage::disk('public')->put($path, file_get_contents($source));
        }

        return [
            'id_pesanan_mako' => PesananMako::factory(), // akan ditimpa di seeder jika perlu
            'id_konsumen' => null,
            'no_rekening_penerima' => $this->faker->bankAccountNumber,
            'nama_bank_penerima' => $this->faker->randomElement(['BRI', 'BCA', 'BNI', 'Mandiri']),
            'nama_penerima' => $this->faker->name,
            'cara_pembayaran' => $this->faker->randomElement(['transfer', 'tunai']),
            'nama_pengirim' => $this->faker->name,
            'nama_bank_pengirim' => $this->faker->randomElement(['BRI', 'BCA', 'BNI', 'Mandiri']),
            'bukti_pembayaran' => $path,
            'status' => $this->faker->randomElement(['menunggu pembayaran', 'lunas']),
        ];
    }
}
