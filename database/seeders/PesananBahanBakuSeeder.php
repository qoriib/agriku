<?php

namespace Database\Seeders;

use App\Models\FormulirPemesananBahanBaku;
use App\Models\Karyawan;
use App\Models\Pemasok;
use App\Models\PesananBahanBaku;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PesananBahanBakuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $karyawans = Karyawan::all();
        $pemasoks = Pemasok::all();

        if ($karyawans->isEmpty() || $pemasoks->isEmpty()) {
            $this->command->warn('Seeder dilewati karena tidak ada karyawan atau pemasok.');
            return;
        }

        foreach ($karyawans as $karyawan) {
            foreach (range(1, 3) as $i) {
                $pemasok = $pemasoks->random();

                $formulir = FormulirPemesananBahanBaku::create([
                    'kode_pemesanan_bahan_baku' => strtoupper(Str::random(8)),
                    'nama_bahan_baku' => fake()->randomElement(['Gula', 'Beras', 'Garam', 'Tepung']),
                    'qty' => fake()->numberBetween(10, 100),
                    'tanggal_pemesanan' => now()->subDays(rand(1, 30)),
                    'alamat_pengiriman' => fake()->address,
                    'harga' => fake()->numberBetween(10000, 50000),
                    'pajak' => fake()->numberBetween(1000, 5000),
                    'total_harga' => 0, // dihitung di bawah
                    'id_karyawan' => $karyawan->id,
                    'id_pemasok' => $pemasok->id,
                ]);

                // Hitung total harga yang benar
                $formulir->total_harga = ($formulir->harga * $formulir->qty) + $formulir->pajak;
                $formulir->save();

                PesananBahanBaku::factory()->create([
                    'id_formulir_pemesanan_bahan_baku' => $formulir->id,
                    'id_karyawan' => $karyawan->id,
                    'id_pemasok' => $pemasok->id,
                ]);
            }
        }
    }
}
