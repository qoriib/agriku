<?php

namespace App\Http\Controllers\Divisi;

use App\Http\Controllers\Controller;
use App\Models\PembayaranMako;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembayaranMakoController extends Controller
{
    public function index()
    {
        $pembayarans = PembayaranMako::with('pesananMako.formulirPemesananMako')
            ->latest()
            ->get();

        return view('divisi.pembayaran.index', compact('pembayarans'));
    }

    public function show($id)
    {
        $pembayaran = PembayaranMako::with('pesananMako.formulirPemesananMako')->findOrFail($id);
        return view('divisi.pembayaran.show', compact('pembayaran'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:menunggu pembayaran,lunas',
        ]);

        $pembayaran = PembayaranMako::findOrFail($id);
        $pembayaran->update([
            'status' => $validated['status'],
        ]);

        return redirect()->route('divisi.pembayaran.index')->with('success', 'Status pembayaran diperbarui.');
    }

    public function destroy($id)
    {
        $pembayaran = PembayaranMako::findOrFail($id);

        if ($pembayaran->bukti_pembayaran) {
            Storage::disk('public')->delete($pembayaran->bukti_pembayaran);
        }

        $pembayaran->delete();

        return redirect()->route('divisi.pembayaran.index')->with('success', 'Pembayaran dihapus.');
    }
}
