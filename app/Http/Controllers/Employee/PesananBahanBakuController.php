<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\PesananBahanBaku;
use App\Models\FormulirPemesananBahanBaku;
use App\Models\Pemasok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananBahanBakuController extends Controller
{
    public function index()
    {
        $pesanans = PesananBahanBaku::with(['formulirPemesanan', 'karyawan', 'pemasok'])
            ->where('id_karyawan', Auth::user()->karyawan->id)
            ->get();

        return view('employee.pengadaan.index', compact('pesanans'));
    }

    public function create()
    {
        $pemasoks = Pemasok::all();
        return view('employee.pengadaan.create', compact('pemasoks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_pemesanan_bahan_baku' => 'required|string',
            'nama_bahan_baku' => 'required|string',
            'qty' => 'required|integer|min:1',
            'tanggal_pemesanan' => 'required|date',
            'alamat_pengiriman' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'pajak' => 'required|numeric|min:0',
        ]);

        $total_harga = ($validated['harga'] * $validated['qty']) + $validated['pajak'];

        $formulir = FormulirPemesananBahanBaku::create([
            'kode_pemesanan_bahan_baku' => $validated['kode_pemesanan_bahan_baku'],
            'nama_bahan_baku' => $validated['nama_bahan_baku'],
            'qty' => $validated['qty'],
            'tanggal_pemesanan' => $validated['tanggal_pemesanan'],
            'alamat_pengiriman' => $validated['alamat_pengiriman'],
            'harga' => $validated['harga'],
            'pajak' => $validated['pajak'],
            'total_harga' => $total_harga,
            'id_karyawan' => Auth::user()->karyawan->id,
            'id_pemasok' => $request->id_pemasok,
        ]);

        PesananBahanBaku::create([
            'id_formulir_pemesanan_bahan_baku' => $formulir->id,
            'id_karyawan' => Auth::user()->karyawan->id,
            'id_pemasok' => $formulir->id_pemasok,
            'status' => 'menunggu',
        ]);

        return redirect()->route('employee.pengadaan.index')->with('success', 'Pesanan berhasil dibuat.');
    }

    public function edit($id)
    {
        $pesanan = PesananBahanBaku::with(['formulirPemesanan', 'pemasok'])->findOrFail($id);
        $pemasoks = Pemasok::all();

        return view('employee.pengadaan.edit', compact('pesanan', 'pemasoks'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kode_pemesanan_bahan_baku' => 'required|string',
            'nama_bahan_baku' => 'required|string',
            'qty' => 'required|integer|min:1',
            'tanggal_pemesanan' => 'required|date',
            'alamat_pengiriman' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'pajak' => 'required|numeric|min:0',
        ]);

        $total_harga = ($validated['harga'] * $validated['qty']) + $validated['pajak'];

        $pesanan = PesananBahanBaku::findOrFail($id);
        $formulir = $pesanan->formulirPemesanan;

        $formulir->update([
            'kode_pemesanan_bahan_baku' => $validated['kode_pemesanan_bahan_baku'],
            'nama_bahan_baku' => $validated['nama_bahan_baku'],
            'qty' => $validated['qty'],
            'tanggal_pemesanan' => $validated['tanggal_pemesanan'],
            'alamat_pengiriman' => $validated['alamat_pengiriman'],
            'harga' => $validated['harga'],
            'pajak' => $validated['pajak'],
            'total_harga' => $total_harga,
            'id_pemasok' => $request->id_pemasok,
        ]);

        $pesanan->status = 'menunggu';
        $pesanan->save();

        return redirect()->route('employee.pengadaan.index')->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pesanan = PesananBahanBaku::findOrFail($id);
        $formulir = $pesanan->formulirPemesanan;

        $pesanan->delete();
        $formulir->delete();

        return redirect()->route('employee.pengadaan.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
