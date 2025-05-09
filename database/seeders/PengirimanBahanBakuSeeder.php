<?php

namespace Database\Seeders;

use App\Models\PengirimanBahanBaku;
use App\Models\PesananBahanBaku;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Database\Seeder;

class PengirimanBahanBakuSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user dengan role 'staf_logistik' dan ambil relasi karyawannya
        $userLogistik = User::where('role', 'staf_logistik')->inRandomOrder()->first();

        if (!$userLogistik || !$userLogistik->karyawan) {
            $this->command->warn('Tidak ada user dengan role staf_logistik atau tidak memiliki relasi karyawan.');
            return;
        }

        $karyawan = $userLogistik->karyawan;

        // Ambil semua pesanan diterima dan belum memiliki pengiriman
        $pesanans = PesananBahanBaku::with('formulirPemesanan')
            ->where('status', 'diterima')
            ->get();

        foreach ($pesanans as $pesanan) {
            if ($pesanan->pengirimanBahanBaku) continue;

            PengirimanBahanBaku::factory()->create([
                'id_pesanan_bahan_baku' => $pesanan->id,
                'id_pemasok' => $pesanan->id_pemasok,
                'id_karyawan' => $karyawan->id,
            ]);
        }
    }
}
