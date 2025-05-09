<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\PengirimanBahanBaku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengirimanBahanBakuController extends Controller
{
    public function index()
    {
        $pemasokId = Auth::user()->pemasok->id;

        $pengirimans = PengirimanBahanBaku::with('pesananBahanBaku.formulirPemesanan')
            ->whereHas('pesananBahanBaku', function ($query) use ($pemasokId) {
                $query->where('id_pemasok', $pemasokId);
            })
            ->latest()
            ->get();

        return view('supplier.pengiriman.index', compact('pengirimans'));
    }

    public function edit($id)
    {
        $pengiriman = PengirimanBahanBaku::with('pesananBahanBaku.formulirPemesanan')->findOrFail($id);

        if ($pengiriman->pesananBahanBaku->id_pemasok !== Auth::user()->pemasok->id) {
            abort(403);
        }

        return view('supplier.pengiriman.edit', compact('pengiriman'));
    }

    public function update(Request $request, $id)
    {
        $pengiriman = PengirimanBahanBaku::with('pesananBahanBaku')->findOrFail($id);

        if ($pengiriman->pesananBahanBaku->id_pemasok !== Auth::user()->pemasok->id) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:dikirim,diterima',
            'bukti_pengiriman' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('bukti_pengiriman')) {
            $path = $request->file('bukti_pengiriman')->store('bukti_pengiriman_bahan_baku', 'public');
            $pengiriman->bukti_pengiriman = $path;
        }

        $pengiriman->status = $request->status;
        $pengiriman->save();

        return redirect()->route('supplier.pengiriman.index')->with('success', 'Data pengiriman berhasil diperbarui.');
    }
}
