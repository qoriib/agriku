<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\PengirimanMako;
use App\Models\PesananMako;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengirimanMakoController extends Controller
{
    public function index()
    {
        $pengirimans = PengirimanMako::with(['pesananMako', 'karyawan'])->latest()->get();
        return view('employee.pengiriman.index', compact('pengirimans'));
    }

    public function create()
    {
        $pesanans = PesananMako::where('status', 'diterima')->get(); // hanya pesanan siap kirim
        return view('employee.pengiriman.create', compact('pesanans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pesanan_mako' => 'required|exists:pesanan_mako,id',
            'estimasi_sampai' => 'required|date',
            'bukti_pengiriman' => 'required|image|max:2048',
        ]);

        $bukti = $request->file('bukti_pengiriman')->store('bukti_pengiriman_mako', 'public');

        PengirimanMako::create([
            'id_pesanan_mako' => $validated['id_pesanan_mako'],
            'id_konsumen' => PesananMako::find($validated['id_pesanan_mako'])->id_konsumen,
            'id_karyawan' => Auth::user()->karyawan->id,
            'estimasi_sampai' => $validated['estimasi_sampai'],
            'bukti_pesanan_diterima' => $bukti,
            'status' => 'dikirim',
        ]);

        return redirect()->route('employee.pengiriman.index')->with('success', 'Data pengiriman berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pengiriman = PengirimanMako::findOrFail($id);
        return view('employee.pengiriman.edit', compact('pengiriman'));
    }

    public function update(Request $request, $id)
    {
        $pengiriman = PengirimanMako::findOrFail($id);

        $validated = $request->validate([
            'estimasi_sampai' => 'required|date',
            'status' => 'required|in:dikirim,terlambat,diterima',
            'bukti_pesanan_diterima' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('bukti_pesanan_diterima')) {
            if ($pengiriman->bukti_pesanan_diterima) {
                Storage::disk('public')->delete($pengiriman->bukti_pesanan_diterima);
            }

            $validated['bukti_pesanan_diterima'] = $request->file('bukti_pesanan_diterima')->store('bukti_pengiriman_mako', 'public');
        }

        $pengiriman->update($validated);

        return redirect()->route('employee.pengiriman.index')->with('success', 'Data pengiriman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengiriman = PengirimanMako::findOrFail($id);

        if ($pengiriman->bukti_pesanan_diterima) {
            Storage::disk('public')->delete($pengiriman->bukti_pesanan_diterima);
        }

        $pengiriman->delete();

        return redirect()->route('employee.pengiriman.index')->with('success', 'Data pengiriman dihapus.');
    }
}
