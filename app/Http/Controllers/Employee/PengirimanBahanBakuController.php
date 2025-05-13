<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\PengirimanBahanBaku;
use Illuminate\Http\Request;

class PengirimanBahanBakuController extends Controller
{
    public function index()
    {
        $pengirimen = PengirimanBahanBaku::with(['pesananBahanBaku.formulirPemesanan', 'pemasok'])->latest()->get();
        return view('employee.pengiriman-bahanbaku.index', compact('pengirimen'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:dikirim,diterima',
        ]);

        $pengiriman = PengirimanBahanBaku::findOrFail($id);
        $pengiriman->update(['status' => $request->status]);

        return redirect()->route('employee.pengiriman-bahanbaku.index')->with('success', 'Status pengiriman berhasil diperbarui.');
    }
}
