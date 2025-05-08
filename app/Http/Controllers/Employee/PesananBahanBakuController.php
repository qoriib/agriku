<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\PesananBahanBaku;
use App\Models\FormulirPemesananBahanBaku;
use App\Models\Pemasok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananBahanBakuController extends Controller
{
    /**
     * Menampilkan semua pesanan konsumen.
     */
    public function index()
    {
        // Ambil semua pesanan konsumen yang sedang login
        $pesanans = PesananBahanBaku::with(['formulirPemesanan', 'karyawan', 'pemasok'])
            ->where('id_karyawan', Auth::user()->karyawan->id) // Filter berdasarkan ID karyawan yang login
            ->get();

        // Tampilkan halaman daftar pesanan
        return view('customer.order.index', compact('pesanans'));
    }

    /**
     * Menampilkan form pemesanan bahan baku
     */
    public function create()
    {
        // Mengambil semua data pemasok
        $pemasoks = Pemasok::all();  // Ambil semua pemasok dari database

        // Menampilkan formulir pemesanan bahan baku dengan data pemasok
        return view('customer.order.create', compact('pemasoks'));  // Mengirim data pemasok ke view
    }

    /**
     * Menyimpan pemesanan bahan baku oleh konsumen
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'kode_pemesanan_bahan_baku' => 'required|string',
            'nama_bahan_baku' => 'required|string',
            'qty' => 'required|integer',
            'tanggal_pemesanan' => 'required|date',
            'alamat_pengiriman' => 'required|string',
            'harga' => 'required|numeric',
            'pajak' => 'required|numeric',
        ]);

        // Hitung total harga
        $total_harga = $validated['harga'] + $validated['pajak'];

        // Simpan formulir pemesanan bahan baku
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
            'id_pemasok' => $request->id_pemasok,  // ID pemasok dari request
        ]);

        // Simpan pesanan bahan baku
        $pesanan = PesananBahanBaku::create([
            'id_formulir_pemesanan_bahan_baku' => $formulir->id,
            'id_karyawan' => Auth::user()->karyawan->id,
            'id_pemasok' => $formulir->id_pemasok,
            'status' => 'menunggu',  // Status awal
        ]);

        // Redirect ke halaman detail pesanan
        return redirect()->route('customer.order.show', $pesanan->id)->with('success', 'Pesanan berhasil dibuat.');
    }

    /**
     * Menampilkan detail pesanan bahan baku
     */
    public function show($id)
    {
        // Ambil data pesanan
        $pesanan = PesananBahanBaku::with(['formulirPemesanan', 'karyawan', 'pemasok'])->findOrFail($id);

        // Tampilkan detail pesanan
        return view('customer.order.show', compact('pesanan'));
    }

    /**
     * Menampilkan status pembayaran untuk pesanan tertentu
     */
    public function showPaymentStatus($id)
    {
        // Ambil data pesanan dan pembayaran
        $pesanan = PesananBahanBaku::with(['formulirPemesanan', 'karyawan', 'pemasok', 'pembayaranBahanBaku'])->findOrFail($id);

        // Tampilkan status pembayaran
        return view('customer.order.payment_status', compact('pesanan'));
    }

    /**
     * Menampilkan form untuk mengedit pesanan
     */
    public function edit($id)
    {
        // Ambil pesanan berdasarkan ID
        $pesanan = PesananBahanBaku::with(['formulirPemesanan', 'pemasok'])->findOrFail($id);

        // Ambil daftar pemasok untuk dropdown
        $pemasoks = Pemasok::all();

        // Menampilkan form edit pesanan
        return view('customer.order.edit', compact('pesanan', 'pemasoks'));
    }

    /**
     * Mengupdate pesanan bahan baku
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'kode_pemesanan_bahan_baku' => 'required|string',
            'nama_bahan_baku' => 'required|string',
            'qty' => 'required|integer',
            'tanggal_pemesanan' => 'required|date',
            'alamat_pengiriman' => 'required|string',
            'harga' => 'required|numeric',
            'pajak' => 'required|numeric',
        ]);

        // Hitung total harga
        $total_harga = $validated['harga'] + $validated['pajak'];

        // Ambil pesanan untuk diupdate
        $pesanan = PesananBahanBaku::findOrFail($id);
        $formulir = $pesanan->formulirPemesanan;

        // Update formulir pemesanan bahan baku
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

        // Update status jika perlu
        $pesanan->status = 'menunggu'; // Atau status lainnya sesuai kebutuhan
        $pesanan->save();

        // Redirect ke halaman detail pesanan
        return redirect()->route('customer.order.show', $pesanan->id)->with('success', 'Pesanan berhasil diperbarui.');
    }

    /**
     * Menghapus pesanan bahan baku
     */
    public function destroy($id)
    {
        // Ambil pesanan yang akan dihapus
        $pesanan = PesananBahanBaku::findOrFail($id);
        $formulir = $pesanan->formulirPemesanan;

        // Hapus pesanan dan formulir pemesanan
        $pesanan->delete();
        $formulir->delete();

        // Redirect ke halaman daftar pesanan
        return redirect()->route('customer.order.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
