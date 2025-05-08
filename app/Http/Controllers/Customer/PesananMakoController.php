<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\PesananMako;
use App\Models\FormulirPemesananMako;
use App\Models\Pemasok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananMakoController extends Controller
{
    /**
     * Menampilkan semua pesanan konsumen.
     */
    public function index()
    {
        // Ambil semua pesanan yang dibuat oleh konsumen yang sedang login
        $pesanans = PesananMako::with(['formulirPemesananMako', 'konsumen', 'pemasok'])
            ->where('id_konsumen', Auth::user()->konsumen->id)  // Filter berdasarkan konsumen yang login
            ->get();

        // Tampilkan halaman daftar pesanan
        return view('customer.mako.index', compact('pesanans'));
    }

    /**
     * Menampilkan formulir pemesanan Mako
     */
    public function create()
    {
        // Ambil semua data pemasok untuk pilihan dropdown
        $pemasoks = Pemasok::all();

        // Tampilkan formulir pemesanan Mako
        return view('customer.mako.create', compact('pemasoks'));
    }

    /**
     * Menyimpan pemesanan Mako
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'jenis_mako' => 'required|in:raskin,premium',
            'qty' => 'required|integer',
            'tanggal_pemesanan' => 'required|date',
            'alamat_pengiriman' => 'required|string',
            'harga' => 'required|numeric',
            'pajak' => 'required|numeric',
        ]);

        // Hitung total harga
        $total_harga = $validated['harga'] * $validated['qty'] + $validated['pajak'];

        // Simpan formulir pemesanan Mako
        $formulir = FormulirPemesananMako::create([
            'jenis_mako' => $validated['jenis_mako'],
            'qty' => $validated['qty'],
            'tanggal_pemesanan' => $validated['tanggal_pemesanan'],
            'alamat_pengiriman' => $validated['alamat_pengiriman'],
            'harga' => $validated['harga'],
            'total_harga' => $total_harga,
            'id_konsumen' => Auth::user()->konsumen->id,
        ]);

        // Simpan pesanan Mako
        $pesanan = PesananMako::create([
            'id_formulir_pemesanan_mako' => $formulir->id,
            'id_konsumen' => Auth::user()->konsumen->id,
            'status' => 'menunggu',  // Status awal
        ]);

        // Redirect ke halaman detail pesanan
        return redirect()->route('customer.mako.show', $pesanan->id)->with('success', 'Pesanan berhasil dibuat.');
    }

    /**
     * Menampilkan detail pesanan Mako
     */
    public function show($id)
    {
        // Ambil data pesanan berdasarkan ID
        $pesanan = PesananMako::with(['formulirPemesananMako', 'konsumen', 'pemasok'])->findOrFail($id);

        // Tampilkan detail pesanan
        return view('customer.mako.show', compact('pesanan'));
    }

    /**
     * Menampilkan form untuk mengedit pesanan
     */
    public function edit($id)
    {
        // Ambil pesanan yang ingin diedit
        $pesanan = PesananMako::with(['formulirPemesananMako', 'pemasok'])->findOrFail($id);

        // Ambil daftar pemasok untuk dropdown
        $pemasoks = Pemasok::all();

        // Tampilkan form edit pesanan
        return view('customer.mako.edit', compact('pesanan', 'pemasoks'));
    }

    /**
     * Mengupdate pesanan Mako
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'jenis_mako' => 'required|in:raskin,premium',
            'qty' => 'required|integer',
            'tanggal_pemesanan' => 'required|date',
            'alamat_pengiriman' => 'required|string',
            'harga' => 'required|numeric',
            'pajak' => 'required|numeric',
        ]);

        // Hitung total harga
        $total_harga = $validated['harga'] * $validated['qty'] + $validated['pajak'];

        // Ambil pesanan untuk diupdate
        $pesanan = PesananMako::findOrFail($id);
        $formulir = $pesanan->formulirPemesananMako;

        // Update formulir pemesanan Mako
        $formulir->update([
            'jenis_mako' => $validated['jenis_mako'],
            'qty' => $validated['qty'],
            'tanggal_pemesanan' => $validated['tanggal_pemesanan'],
            'alamat_pengiriman' => $validated['alamat_pengiriman'],
            'harga' => $validated['harga'],
            'total_harga' => $total_harga,
            'id_pemasok' => $request->id_pemasok,
        ]);

        // Update status jika perlu
        $pesanan->status = 'menunggu'; // Atau status lainnya sesuai kebutuhan
        $pesanan->save();

        // Redirect ke halaman detail pesanan
        return redirect()->route('customer.mako.show', $pesanan->id)->with('success', 'Pesanan berhasil diperbarui.');
    }

    /**
     * Menghapus pesanan Mako
     */
    public function destroy($id)
    {
        // Ambil pesanan yang akan dihapus
        $pesanan = PesananMako::findOrFail($id);
        $formulir = $pesanan->formulirPemesananMako;

        // Hapus pesanan dan formulir pemesanan
        $pesanan->delete();
        $formulir->delete();

        // Redirect ke halaman daftar pesanan
        return redirect()->route('customer.mako.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
