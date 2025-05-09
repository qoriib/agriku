<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\PembayaranBahanBaku;
use App\Models\PesananBahanBaku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PembayaranBahanBakuController extends Controller
{
    public function index()
    {
        $pembayarans = PembayaranBahanBaku::with('pesananBahanBaku.formulirPemesanan')
            ->where('id_karyawan', Auth::user()->karyawan->id)
            ->latest()
            ->get();

        return view('employee.pembayaran.index', compact('pembayarans'));
    }

    public function create($pesanan_id)
    {
        $pesanan = PesananBahanBaku::with('formulirPemesanan')->findOrFail($pesanan_id);

        if ($pesanan->id_karyawan !== Auth::user()->karyawan->id || $pesanan->pembayaranBahanBaku) {
            abort(403, 'Tidak diizinkan.');
        }

        return view('employee.pembayaran.create', compact('pesanan'));
    }

    public function store(Request $request, $pesanan_id)
    {
        $pesanan = PesananBahanBaku::findOrFail($pesanan_id);

        if ($pesanan->id_karyawan !== Auth::user()->karyawan->id || $pesanan->pembayaranBahanBaku) {
            abort(403);
        }

        $validated = $request->validate([
            'no_rekening_penerima' => 'required|string',
            'nama_bank_penerima' => 'required|string',
            'nama_pengirim' => 'required|string',
            'nama_bank_pengirim' => 'required|string',
            'bukti_pembayaran' => 'required|image|max:2048',
        ]);

        $buktiPath = $request->file('bukti_pembayaran')->store('pembayaran_bahan_baku', 'public');

        PembayaranBahanBaku::create([
            'id_pesanan_bahan_baku' => $pesanan->id,
            'id_karyawan' => Auth::user()->karyawan->id,
            'no_rekening_penerima' => $validated['no_rekening_penerima'],
            'nama_bank_penerima' => $validated['nama_bank_penerima'],
            'nama_pengirim' => $validated['nama_pengirim'],
            'nama_bank_pengirim' => $validated['nama_bank_pengirim'],
            'bukti_pembayaran' => $buktiPath,
            'status' => 'menunggu pembayaran',
        ]);

        return redirect()->route('employee.pembayaran.index')->with('success', 'Pembayaran berhasil dikirim.');
    }

    public function show($id)
    {
        $pembayaran = PembayaranBahanBaku::with('pesananBahanBaku.formulirPemesanan')->findOrFail($id);

        if ($pembayaran->id_karyawan !== Auth::user()->karyawan->id) {
            abort(403);
        }

        return view('employee.pembayaran.show', compact('pembayaran'));
    }

    public function edit($id)
    {
        $pembayaran = PembayaranBahanBaku::findOrFail($id);

        if ($pembayaran->id_karyawan !== Auth::user()->karyawan->id || $pembayaran->status === 'lunas') {
            abort(403);
        }

        return view('employee.pembayaran.edit', compact('pembayaran'));
    }

    public function update(Request $request, $id)
    {
        $pembayaran = PembayaranBahanBaku::findOrFail($id);

        if ($pembayaran->id_karyawan !== Auth::user()->karyawan->id || $pembayaran->status === 'lunas') {
            abort(403);
        }

        $validated = $request->validate([
            'no_rekening_penerima' => 'required|string',
            'nama_bank_penerima' => 'required|string',
            'nama_pengirim' => 'required|string',
            'nama_bank_pengirim' => 'required|string',
            'bukti_pembayaran' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('bukti_pembayaran')) {
            if ($pembayaran->bukti_pembayaran) {
                Storage::disk('public')->delete($pembayaran->bukti_pembayaran);
            }

            $pembayaran->bukti_pembayaran = $request->file('bukti_pembayaran')->store('pembayaran_bahan_baku', 'public');
        }

        $pembayaran->update([
            'no_rekening_penerima' => $validated['no_rekening_penerima'],
            'nama_bank_penerima' => $validated['nama_bank_penerima'],
            'nama_pengirim' => $validated['nama_pengirim'],
            'nama_bank_pengirim' => $validated['nama_bank_pengirim'],
        ]);

        return redirect()->route('employee.pembayaran.index')->with('success', 'Pembayaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pembayaran = PembayaranBahanBaku::findOrFail($id);

        if ($pembayaran->id_karyawan !== Auth::user()->karyawan->id || $pembayaran->status === 'lunas') {
            abort(403);
        }

        if ($pembayaran->bukti_pembayaran) {
            Storage::disk('public')->delete($pembayaran->bukti_pembayaran);
        }

        $pembayaran->delete();

        return redirect()->route('employee.pembayaran.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}
