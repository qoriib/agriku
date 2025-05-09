<?php

namespace Database\Seeders;

use App\Models\PembayaranBahanBaku;
use App\Models\PesananBahanBaku;
use Illuminate\Database\Seeder;

class PembayaranBahanBakuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pesanans = PesananBahanBaku::with('pembayaranBahanBaku')
            ->where('status', 'diterima')
            ->get();

        foreach ($pesanans as $pesanan) {
            // Lewati jika sudah memiliki pembayaran
            if ($pesanan->pembayaranBahanBaku) continue;

            PembayaranBahanBaku::factory()->create([
                'id_pesanan_bahan_baku' => $pesanan->id,
                'id_karyawan' => $pesanan->id_karyawan,
            ]);
        }
    }
}
