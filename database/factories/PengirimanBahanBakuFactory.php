<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PengirimanBahanBakuFactory extends Factory
{
    public function definition(): array
    {
        $status = $this->faker->randomElement(['dikirim', 'diterima']);
        $bukti = null;

        if ($status === 'diterima') {
            $folder = 'bukti_pengiriman_bahan_baku';
            Storage::disk('public')->makeDirectory($folder);

            $filename = Str::uuid() . '.jpg';
            $path = "$folder/$filename";

            $sourceImage = public_path('images/sample.png');

            if (file_exists($sourceImage)) {
                Storage::disk('public')->put($path, file_get_contents($sourceImage));
            } else {
                Storage::disk('public')->put($path, 'fake_image_content');
            }

            $bukti = $path;
        }

        return [
            'id_pesanan_bahan_baku' => null, // diisi manual di seeder
            'id_pemasok' => null,
            'id_karyawan' => null, // jika perlu dicantumkan
            'estimasi_sampai' => $this->faker->dateTimeBetween('+1 days', '+7 days'),
            'bukti_pengiriman' => $bukti,
            'status' => $status,
        ];
    }
}
