<?php

namespace Database\Seeders;

use App\Models\PengirimanMako;
use App\Models\PesananMako;
use App\Models\Karyawan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PengirimanMakoSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan direktori untuk bukti tersedia
        Storage::disk('public')->makeDirectory('bukti_pesanan_mako_diterima');

        // Ambil satu karyawan secara acak
        $karyawan = Karyawan::inRandomOrder()->first();
        if (!$karyawan) return;

        // Ambil semua pesanan mako yang statusnya diterima dan sudah lunas
        $pesanans = PesananMako::with('pembayaranMako')
            ->where('status', 'diterima')
            ->get();

        foreach ($pesanans as $pesanan) {
            $pembayaran = $pesanan->pembayaranMako;

            // Lewati jika tidak punya pembayaran atau belum lunas
            if (!$pembayaran || $pembayaran->status !== 'lunas') continue;

            // Lewati jika sudah dikirim sebelumnya
            if ($pesanan->pengirimanMako) continue;

            // Gunakan factory dengan isian manual untuk relasi
            PengirimanMako::factory()->create([
                'id_pesanan_mako' => $pesanan->id,
                'id_konsumen' => $pesanan->id_konsumen,
                'id_karyawan' => $karyawan->id,
            ]);
        }
    }
}
