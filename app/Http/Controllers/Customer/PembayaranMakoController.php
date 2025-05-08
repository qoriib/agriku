<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\PembayaranMako;
use App\Models\PesananMako;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PembayaranMakoController extends Controller
{
    /**
     * Menampilkan daftar pembayaran oleh konsumen yang login.
     */
    public function index()
    {
        $pembayarans = PembayaranMako::with('pesananMako.formulirPemesananMako')
            ->where('id_konsumen', Auth::user()->konsumen->id)
            ->latest()
            ->get();

        return view('customer.pembayaran.index', compact('pembayarans'));
    }

    /**
     * Menampilkan form upload pembayaran untuk pesanan tertentu.
     */
    public function create($pesananId)
    {
        $pesanan = PesananMako::findOrFail($pesananId);

        if ($pesanan->id_konsumen !== Auth::user()->konsumen->id) {
            abort(403);
        }

        return view('customer.pembayaran.create', compact('pesanan'));
    }

    /**
     * Menyimpan pembayaran baru.
     */
    public function store(Request $request, $pesananId)
    {
        $pesanan = PesananMako::findOrFail($pesananId);

        if ($pesanan->id_konsumen !== Auth::user()->konsumen->id) {
            abort(403);
        }

        $validated = $request->validate([
            'no_rekening_penerima' => 'required|string',
            'nama_bank_penerima' => 'required|string',
            'nama_penerima' => 'required|string',
            'cara_pembayaran' => 'required|in:transfer,tunai',
            'nama_pengirim' => 'required|string',
            'nama_bank_pengirim' => 'required|string',
            'bukti_pembayaran' => 'required|image|max:2048',
        ]);

        $buktiPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        PembayaranMako::create([
            'id_pesanan_mako' => $pesanan->id,
            'id_konsumen' => Auth::user()->konsumen->id,
            'no_rekening_penerima' => $validated['no_rekening_penerima'],
            'nama_bank_penerima' => $validated['nama_bank_penerima'],
            'nama_penerima' => $validated['nama_penerima'],
            'cara_pembayaran' => $validated['cara_pembayaran'],
            'nama_pengirim' => $validated['nama_pengirim'],
            'nama_bank_pengirim' => $validated['nama_bank_pengirim'],
            'bukti_pembayaran' => $buktiPath,
            'status' => 'menunggu pembayaran',
        ]);

        return redirect()->route('customer.mako.show', $pesanan->id)->with('success', 'Pembayaran berhasil dikirim.');
    }

    /**
     * Menampilkan detail pembayaran.
     */
    public function show($id)
    {
        $pembayaran = PembayaranMako::with('pesananMako.formulirPemesananMako')->findOrFail($id);

        if ($pembayaran->id_konsumen !== Auth::user()->konsumen->id) {
            abort(403);
        }

        return view('customer.pembayaran.show', compact('pembayaran'));
    }

    /**
     * Menghapus pembayaran (jika belum lunas).
     */
    public function destroy($id)
    {
        $pembayaran = PembayaranMako::findOrFail($id);

        if ($pembayaran->id_konsumen !== Auth::user()->konsumen->id) {
            abort(403);
        }

        if ($pembayaran->status === 'lunas') {
            return back()->with('error', 'Pembayaran tidak bisa dihapus karena sudah dikonfirmasi.');
        }

        Storage::disk('public')->delete($pembayaran->bukti_pembayaran);
        $pembayaran->delete();

        return redirect()->route('customer.pembayaran.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}
