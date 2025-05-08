<?php

namespace Database\Seeders;

use App\Models\Barcode;
use App\Models\Persediaan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class PersediaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Barcode::all() as $barcode) {
            $qty_sisa = 0;

            // Buat 5 riwayat masuk/keluar berdasarkan tanggal
            $riwayats = collect();

            for ($i = 0; $i < 5; $i++) {
                $tipe = Arr::random(['masuk', 'keluar']);
                $qty = rand(10, 50);
                $tanggal = now()->subDays(rand(0, 60))->format('Y-m-d');

                $riwayats->push([
                    'tipe' => $tipe,
                    'qty_produk' => $qty,
                    'tanggal' => $tanggal,
                ]);
            }

            // Urutkan berdasarkan tanggal
            $riwayats = $riwayats->sortBy('tanggal');

            // Simpan riwayat dengan perhitungan qty_sisa
            foreach ($riwayats as $data) {
                if ($data['tipe'] === 'masuk') {
                    $qty_sisa += $data['qty_produk'];
                } else {
                    $qty_sisa -= $data['qty_produk'];
                    $qty_sisa = max($qty_sisa, 0);
                }

                Persediaan::create([
                    'id_barcode' => $barcode->id,
                    'tipe' => $data['tipe'],
                    'qty_produk' => $data['qty_produk'],
                    'tanggal' => $data['tanggal'],
                    'qty_sisa' => $qty_sisa,
                ]);
            }
        }
    }
}
