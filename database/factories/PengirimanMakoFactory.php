<?php

namespace Database\Factories;

use App\Models\PengirimanMako;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PengirimanMako>
 */
class PengirimanMakoFactory extends Factory
{
    protected $model = PengirimanMako::class;

    public function definition(): array
    {
        $status = $this->faker->randomElement(['dikirim', 'diterima']);
        $bukti = null;

        if ($status === 'diterima') {
            // Pastikan direktori tersedia
            $folder = 'bukti_pesanan_mako_diterima';
            Storage::disk('public')->makeDirectory($folder);

            // Simulasi file bukti
            $filename = $this->faker->uuid . '.png';
            $path = "$folder/$filename";

            Storage::disk('public')->put($path, file_get_contents(public_path('images/sample.png')));

            $bukti = $path;
        }

        return [
            'id_pesanan_mako' => null,     // Diisi manual dari seeder
            'id_konsumen' => null,
            'id_karyawan' => null,
            'estimasi_sampai' => $this->faker->dateTimeBetween('+1 days', '+5 days'),
            'bukti_pesanan_diterima' => $bukti,
            'status' => $status,
        ];
    }
}
