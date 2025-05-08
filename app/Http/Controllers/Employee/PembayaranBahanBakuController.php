<?php

namespace App\Http\Controllers;

use App\Models\PembayaranBahanBaku;
use App\Models\PesananBahanBaku;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranBahanBakuController extends Controller
{
    /**
     * Menampilkan daftar pembayaran bahan baku
     */
    public function index()
    {
        // Mengambil semua data pembayaran bahan baku
        $pembayarans = PembayaranBahanBaku::with(['pesananBahanBaku', 'karyawan'])->get();

        // Menampilkan halaman daftar pembayaran
        return view('pembayaran.index', compact('pembayarans'));
    }

    /**
     * Menampilkan form untuk membuat pembayaran baru
     */
    public function create($pesanan_id)
    {
        // Ambil pesanan berdasarkan ID
        $pesanan = PesananBahanBaku::findOrFail($pesanan_id);

        // Menampilkan form untuk membuat pembayaran
        return view('pembayaran.create', compact('pesanan'));
    }

    /**
     * Menyimpan data pembayaran bahan baku
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'no_rekening_penerima' => 'required|string',
            'nama_bank_penerima' => 'required|string',
            'nama_pengirim' => 'required|string',
            'nama_bank_pengirim' => 'required|string',
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf',
        ]);

        // Simpan file bukti pembayaran
        $path = $request->file('bukti_pembayaran')->store('public/pembayaran_bahan_baku');

        // Simpan data pembayaran ke database
        PembayaranBahanBaku::create([
            'id_pesanan_bahan_baku' => $request->id_pesanan_bahan_baku,
            'id_karyawan' => Auth::user()->karyawan->id,
            'no_rekening_penerima' => $validated['no_rekening_penerima'],
            'nama_bank_penerima' => $validated['nama_bank_penerima'],
            'nama_pengirim' => $validated['nama_pengirim'],
            'nama_bank_pengirim' => $validated['nama_bank_pengirim'],
            'bukti_pembayaran' => $path,
            'status' => 'menunggu pembayaran',  // Status awal
        ]);

        // Redirect ke halaman daftar pembayaran
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dibuat.');
    }

    /**
     * Menampilkan detail pembayaran
     */
    public function show($id)
    {
        // Ambil data pembayaran berdasarkan ID
        $pembayaran = PembayaranBahanBaku::with(['pesananBahanBaku', 'karyawan'])->findOrFail($id);

        // Menampilkan detail pembayaran
        return view('pembayaran.show', compact('pembayaran'));
    }

    /**
     * Menampilkan form untuk mengedit pembayaran
     */
    public function edit($id)
    {
        // Ambil data pembayaran untuk diedit
        $pembayaran = PembayaranBahanBaku::findOrFail($id);

        // Menampilkan form edit pembayaran
        return view('pembayaran.edit', compact('pembayaran'));
    }

    /**
     * Mengupdate data pembayaran
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'no_rekening_penerima' => 'required|string',
            'nama_bank_penerima' => 'required|string',
            'nama_pengirim' => 'required|string',
            'nama_bank_pengirim' => 'required|string',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        // Ambil data pembayaran yang akan diupdate
        $pembayaran = PembayaranBahanBaku::findOrFail($id);

        // Jika ada bukti pembayaran baru, simpan file-nya
        if ($request->hasFile('bukti_pembayaran')) {
            $path = $request->file('bukti_pembayaran')->store('public/pembayaran_bahan_baku');
            $pembayaran->bukti_pembayaran = $path;
        }

        // Update data pembayaran
        $pembayaran->update([
            'no_rekening_penerima' => $validated['no_rekening_penerima'],
            'nama_bank_penerima' => $validated['nama_bank_penerima'],
            'nama_pengirim' => $validated['nama_pengirim'],
            'nama_bank_pengirim' => $validated['nama_bank_pengirim'],
            'status' => $request->status,  // Status pembayaran bisa diperbarui
        ]);

        // Redirect ke halaman daftar pembayaran
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil diperbarui.');
    }

    /**
     * Menghapus data pembayaran
     */
    public function destroy($id)
    {
        // Hapus data pembayaran
        PembayaranBahanBaku::destroy($id);

        // Redirect ke halaman daftar pembayaran
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}
