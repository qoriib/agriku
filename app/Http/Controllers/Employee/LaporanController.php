<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\PesananBahanBaku;
use App\Models\PesananMako;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function bahanBaku(Request $request)
    {
        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        $query = PesananBahanBaku::with(['formulirPemesanan', 'pemasok'])
            ->where('status', 'diterima');

        if ($tanggalAwal && $tanggalAkhir) {
            $query->whereHas('formulirPemesanan', function ($q) use ($tanggalAwal, $tanggalAkhir) {
                $q->whereBetween('tanggal_pemesanan', [$tanggalAwal, $tanggalAkhir]);
            });
        }

        $pesanans = $query->get();

        return view('employee.laporan.bahanbaku', compact('pesanans', 'tanggalAwal', 'tanggalAkhir'));
    }

    public function printBahanBaku(Request $request)
    {
        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        $query = PesananBahanBaku::with(['formulirPemesanan', 'pemasok'])
            ->where('status', 'diterima');

        if ($tanggalAwal && $tanggalAkhir) {
            $query->whereHas('formulirPemesanan', function ($q) use ($tanggalAwal, $tanggalAkhir) {
                $q->whereBetween('tanggal_pemesanan', [$tanggalAwal, $tanggalAkhir]);
            });
        }

        $pesanans = $query->get();

        return view('employee.laporan.print_bahanbaku', compact('pesanans', 'tanggalAwal', 'tanggalAkhir'));
    }

    public function penjualan(Request $request)
    {
        $query = PesananMako::with(['formulirPemesananMako', 'konsumen.user', 'pembayaranMako'])
            ->whereHas('formulirPemesananMako', function ($q) use ($request) {
                if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
                    $q->whereBetween('tanggal_pemesanan', [$request->tanggal_awal, $request->tanggal_akhir]);
                }
            })
            ->where('status', 'diterima') // hanya yang sudah diterima
            ->latest();

        $pesanans = $query->get();

        return view('employee.laporan.penjualan', compact('pesanans'));
    }

    public function printPenjualan(Request $request)
    {
        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        $query = PesananMako::with(['formulirPemesananMako', 'konsumen.user', 'pembayaranMako']);

        if ($tanggalAwal && $tanggalAkhir) {
            $query->whereHas('formulirPemesananMako', function ($q) use ($request) {
                $q->whereBetween('tanggal_pemesanan', [$request->tanggal_awal, $request->tanggal_akhir]);
            });
        }

        $pesanans = $query->get();

        return view('employee.laporan.print_penjualan', compact('pesanans', 'tanggalAwal', 'tanggalAkhir'));
    }
}
