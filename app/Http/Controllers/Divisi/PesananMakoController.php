<?php

namespace App\Http\Controllers\Divisi;

use App\Http\Controllers\Controller;
use App\Models\PesananMako;
use Illuminate\Http\Request;

class PesananMakoController extends Controller
{
    /**
     * Tampilkan daftar seluruh pesanan Mako.
     */
    public function index()
    {
        $pesanans = PesananMako::with('formulirPemesananMako', 'konsumen.user')
            ->latest()
            ->get();

        return view('divisi.pesanan.index', compact('pesanans'));
    }

    /**
     * Perbarui status pesanan Mako.
     */
    public function update(Request $request, $id)
    {
        $pesanan = PesananMako::findOrFail($id);

        $request->validate([
            'status' => 'required|in:menunggu,diterima',
        ]);

        $pesanan->status = $request->status;
        $pesanan->save();

        return redirect()->route('divisi.pesanan.index')->with('success', 'Status pesanan berhasil diperbarui.');
    }

    /**
     * Hapus pesanan dan formulir terkait.
     */
    public function destroy($id)
    {
        $pesanan = PesananMako::findOrFail($id);

        // Hapus formulir dan pesanan
        $pesanan->formulirPemesananMako->delete();
        $pesanan->delete();

        return redirect()->route('divisi.pesanan.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
