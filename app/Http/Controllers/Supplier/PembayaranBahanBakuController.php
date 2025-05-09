<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\PembayaranBahanBaku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranBahanBakuController extends Controller
{
    public function index()
    {
        $pemasokId = Auth::user()->pemasok->id;

        $pembayarans = PembayaranBahanBaku::with(['pesananBahanBaku.formulirPemesanan'])
            ->whereHas('pesananBahanBaku', function ($query) use ($pemasokId) {
                $query->where('id_pemasok', $pemasokId);
            })
            ->latest()
            ->get();

        return view('supplier.pembayaran.index', compact('pembayarans'));
    }

    public function edit($id)
    {
        $pembayaran = PembayaranBahanBaku::with('pesananBahanBaku.formulirPemesanan')->findOrFail($id);

        if ($pembayaran->pesananBahanBaku->id_pemasok !== Auth::user()->pemasok->id) {
            abort(403);
        }

        return view('supplier.pembayaran.edit', compact('pembayaran'));
    }

    public function update(Request $request, $id)
    {
        $pembayaran = PembayaranBahanBaku::with('pesananBahanBaku')->findOrFail($id);

        if ($pembayaran->pesananBahanBaku->id_pemasok !== Auth::user()->pemasok->id) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:menunggu pembayaran,lunas',
        ]);

        $pembayaran->update([
            'status' => $validated['status'],
        ]);

        return redirect()->route('supplier.pembayaran.index')->with('success', 'Status pembayaran berhasil diperbarui.');
    }
}
