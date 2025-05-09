<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\PengirimanMako;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PengirimanMakoController extends Controller
{
    public function index()
    {
        $konsumenId = Auth::user()->konsumen->id;

        $pengirimans = PengirimanMako::with(['pesananMako.formulirPemesananMako', 'karyawan.user'])
            ->where('id_konsumen', $konsumenId)
            ->latest()
            ->get();

        return view('customer.pengiriman.index', compact('pengirimans'));
    }

    public function showKonfirmasi($id)
    {
        $pengiriman = PengirimanMako::where('id', $id)
            ->where('id_konsumen', Auth::user()->konsumen->id)
            ->where('status', 'dikirim')
            ->firstOrFail();

        return view('customer.pengiriman.konfirmasi', compact('pengiriman'));
    }

    public function prosesKonfirmasi(Request $request, $id)
    {
        $pengiriman = PengirimanMako::where('id', $id)
            ->where('id_konsumen', Auth::user()->konsumen->id)
            ->where('status', 'dikirim')
            ->firstOrFail();

        $request->validate([
            'bukti_pesanan_diterima' => 'required|image|max:2048',
        ]);

        // Upload bukti
        $path = $request->file('bukti_pesanan_diterima')->store('bukti_pesanan_diterima', 'public');

        $pengiriman->update([
            'bukti_pesanan_diterima' => $path,
            'status' => 'diterima',
        ]);

        return redirect()->route('customer.pengiriman.index')->with('success', 'Pengiriman telah dikonfirmasi diterima.');
    }
}
