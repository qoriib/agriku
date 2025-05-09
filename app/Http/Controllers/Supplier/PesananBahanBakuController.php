<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\PesananBahanBaku;
use App\Models\FormulirPemesananBahanBaku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananBahanBakuController extends Controller
{
    public function index()
    {
        $pemasokId = Auth::user()->pemasok->id;

        $pesanans = PesananBahanBaku::with(['formulirPemesanan', 'karyawan.user'])
            ->where('id_pemasok', $pemasokId)
            ->latest()
            ->get();

        return view('supplier.pesanan.index', compact('pesanans'));
    }

    public function edit($id)
    {
        $pesanan = PesananBahanBaku::with(['formulirPemesanan', 'karyawan.user'])->findOrFail($id);

        if ($pesanan->id_pemasok !== Auth::user()->pemasok->id) {
            abort(403);
        }

        return view('supplier.pesanan.edit', compact('pesanan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_pemesanan_bahan_baku' => 'required|string',
            'nama_bahan_baku' => 'required|string',
            'qty' => 'required|integer',
            'tanggal_pemesanan' => 'required|date',
            'alamat_pengiriman' => 'required|string',
            'harga' => 'required|numeric',
            'pajak' => 'required|numeric',
            'status' => 'required|in:menunggu,diterima',
        ]);

        $pesanan = PesananBahanBaku::with('formulirPemesanan')->findOrFail($id);

        if ($pesanan->id_pemasok !== Auth::user()->pemasok->id) {
            abort(403);
        }

        $formulir = $pesanan->formulirPemesanan;
        $total_harga = $request->harga * $request->qty + $request->pajak;

        $formulir->update([
            'kode_pemesanan_bahan_baku' => $request->kode_pemesanan_bahan_baku,
            'nama_bahan_baku' => $request->nama_bahan_baku,
            'qty' => $request->qty,
            'tanggal_pemesanan' => $request->tanggal_pemesanan,
            'alamat_pengiriman' => $request->alamat_pengiriman,
            'harga' => $request->harga,
            'pajak' => $request->pajak,
            'total_harga' => $total_harga,
        ]);

        $pesanan->update([
            'status' => $request->status,
        ]);

        return redirect()->route('supplier.pesanan.index')->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diterima',
        ]);

        $pesanan = PesananBahanBaku::findOrFail($id);

        if ($pesanan->id_pemasok !== Auth::user()->pemasok->id) {
            abort(403);
        }

        $pesanan->update([
            'status' => $request->status,
        ]);

        return redirect()->route('supplier.pesanan.index')->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pesanan = PesananBahanBaku::with('formulirPemesanan')->findOrFail($id);

        if ($pesanan->id_pemasok !== Auth::user()->pemasok->id) {
            abort(403);
        }

        $pesanan->formulirPemesanan->delete();
        $pesanan->delete();

        return redirect()->route('supplier.pesanan.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
