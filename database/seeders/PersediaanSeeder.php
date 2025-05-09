<?php

namespace Database\Seeders;

use App\Models\Barcode;
use App\Models\Persediaan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PersediaanSeeder extends Seeder
{
    public function run(): void
    {
        $startDate = Carbon::now()->subDays(30); // mulai dari 30 hari lalu

        foreach (Barcode::all() as $barcode) {
            $qty_sisa = 0;
            $tanggal = clone $startDate;

            // Generate 3 transaksi masuk
            $masukList = [];
            for ($i = 0; $i < 3; $i++) {
                $qty = rand(20, 50);
                $masukList[] = [
                    'id_barcode' => $barcode->id,
                    'tipe' => 'masuk',
                    'qty_produk' => $qty,
                    'tanggal' => $tanggal->copy()->addDays($i),
                ];
                $qty_sisa += $qty;
            }

            // Generate 2 transaksi keluar, total keluar < total masuk
            $keluarList = [];
            $total_keluar = 0;
            for ($j = 0; $j < 2; $j++) {
                $max = floor($qty_sisa / 2); // supaya total keluar tidak melebihi sisa
                $qty = rand(5, max(5, $max));
                $total_keluar += $qty;

                $keluarList[] = [
                    'id_barcode' => $barcode->id,
                    'tipe' => 'keluar',
                    'qty_produk' => $qty,
                    'tanggal' => $tanggal->copy()->addDays(3 + $j),
                ];
            }

            // Gabungkan dan simpan, hitung qty_sisa
            $all = collect([...$masukList, ...$keluarList])->sortBy('tanggal');
            $running_sisa = 0;

            foreach ($all as $data) {
                if ($data['tipe'] === 'masuk') {
                    $running_sisa += $data['qty_produk'];
                } else {
                    $running_sisa -= $data['qty_produk'];
                    $running_sisa = max(0, $running_sisa);
                }

                Persediaan::create($data);
            }
        }
    }
}
