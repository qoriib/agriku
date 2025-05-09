<?php

namespace Database\Factories;

use App\Models\PembayaranBahanBaku;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PembayaranBahanBaku>
 */
class PembayaranBahanBakuFactory extends Factory
{
    protected $model = PembayaranBahanBaku::class;

    public function definition(): array
    {
        // Simulasi upload gambar dummy
        $fileName = 'bukti_' . $this->faker->uuid . '.jpg';
        $filePath = 'pembayaran_bahan_baku/' . $fileName;

        Storage::disk('public')->put($filePath, file_get_contents(public_path('images/sample.png')));

        return [
            'no_rekening_penerima' => $this->faker->bankAccountNumber,
            'nama_bank_penerima' => $this->faker->randomElement(['BCA', 'Mandiri', 'BRI', 'BNI']),
            'nama_pengirim' => $this->faker->name,
            'nama_bank_pengirim' => $this->faker->randomElement(['BCA', 'Mandiri', 'BRI', 'BNI']),
            'bukti_pembayaran' => $filePath,
            'status' => $this->faker->randomElement(['menunggu pembayaran', 'lunas']),
        ];
    }
}
