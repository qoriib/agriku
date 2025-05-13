<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\PesananMako;
use App\Models\FormulirPemesananMako;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananMakoController extends Controller
{
    public function index()
    {
        $pesanans = PesananMako::with('formulirPemesananMako')
            ->where('id_konsumen', Auth::user()->konsumen->id)
            ->get();

        return view('customer.mako.index', compact('pesanans'));
    }

    public function create()
    {
        return view('customer.mako.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_mako' => 'required|in:raskin,premium',
            'qty' => 'required|integer|min:1',
            'tanggal_pemesanan' => 'required|date',
            'alamat_pengiriman' => 'required|string',
            'harga' => 'required|numeric|min:1',
        ]);

        $total_harga = $validated['harga'] * $validated['qty'];

        $formulir = FormulirPemesananMako::create([
            'jenis_mako' => $validated['jenis_mako'],
            'qty' => $validated['qty'],
            'tanggal_pemesanan' => $validated['tanggal_pemesanan'],
            'alamat_pengiriman' => $validated['alamat_pengiriman'],
            'harga' => $validated['harga'],
            'total_harga' => $total_harga,
            'id_konsumen' => Auth::user()->konsumen->id,
        ]);

        PesananMako::create([
            'id_formulir_pemesanan_mako' => $formulir->id,
            'id_konsumen' => Auth::user()->konsumen->id,
            'status' => 'menunggu',
        ]);

        return redirect()->route('customer.mako.index')->with('success', 'Pesanan berhasil dibuat.');
    }

    public function edit($id)
    {
        $pesanan = PesananMako::with('formulirPemesananMako')->findOrFail($id);

        if ($pesanan->id_konsumen !== Auth::user()->konsumen->id) {
            abort(403);
        }

        return view('customer.mako.edit', compact('pesanan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'jenis_mako' => 'required|in:raskin,premium',
            'qty' => 'required|integer|min:1',
            'tanggal_pemesanan' => 'required|date',
            'alamat_pengiriman' => 'required|string',
            'harga' => 'required|numeric|min:1',
        ]);

        $total_harga = $validated['harga'] * $validated['qty'];

        $pesanan = PesananMako::findOrFail($id);

        if ($pesanan->id_konsumen !== Auth::user()->konsumen->id) {
            abort(403);
        }

        $pesanan->formulirPemesananMako->update([
            'jenis_mako' => $validated['jenis_mako'],
            'qty' => $validated['qty'],
            'tanggal_pemesanan' => $validated['tanggal_pemesanan'],
            'alamat_pengiriman' => $validated['alamat_pengiriman'],
            'harga' => $validated['harga'],
            'total_harga' => $total_harga,
        ]);

        $pesanan->update(['status' => 'menunggu']);

        return redirect()->route('customer.mako.index')->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pesanan = PesananMako::findOrFail($id);

        if ($pesanan->id_konsumen !== Auth::user()->konsumen->id) {
            abort(403);
        }

        $pesanan->formulirPemesananMako->delete();
        $pesanan->delete();

        return redirect()->route('customer.mako.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
