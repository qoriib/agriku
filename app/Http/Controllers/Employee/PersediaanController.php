<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Persediaan;
use App\Models\Barcode;
use Illuminate\Http\Request;

class PersediaanController extends Controller
{
    // Menampilkan stok akhir setiap produk
    public function stok()
    {
        $barcodes = Barcode::with(['persediaans' => function ($q) {
            $q->orderByDesc('tanggal');
        }])->get();

        // Ambil hanya stok terbaru per produk
        $stokData = $barcodes->map(function ($barcode) {
            $latest = $barcode->persediaans->first();
            return [
                'barcode' => $barcode,
                'qty_sisa' => $latest?->qty_sisa ?? 0,
                'tanggal' => $latest?->tanggal ?? '-',
            ];
        });

        return view('employee.persediaan.stok', compact('stokData'));
    }

    // Menampilkan riwayat persediaan lengkap
    public function riwayat()
    {
        $persediaans = Persediaan::with('barcode')
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->get();

        return view('employee.persediaan.riwayat', compact('persediaans'));
    }

    public function create()
    {
        $barcodes = Barcode::all();
        return view('employee.persediaan.create', compact('barcodes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_barcode' => 'required|exists:barcode,id',
            'tipe' => 'required|in:masuk,keluar',
            'qty_produk' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        // Hitung qty_sisa terakhir
        $last = Persediaan::where('id_barcode', $validated['id_barcode'])->orderBy('tanggal', 'desc')->first();
        $qty_sisa = $last ? $last->qty_sisa : 0;

        if ($validated['tipe'] === 'masuk') {
            $qty_sisa += $validated['qty_produk'];
        } else {
            $qty_sisa -= $validated['qty_produk'];
            $qty_sisa = max(0, $qty_sisa);
        }

        $validated['qty_sisa'] = $qty_sisa;

        Persediaan::create($validated);

        return redirect()->route('employee.persediaan.riwayat')->with('success', 'Data persediaan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $persediaan = Persediaan::findOrFail($id);
        $barcodes = Barcode::all();
        return view('employee.persediaan.edit', compact('persediaan', 'barcodes'));
    }

    public function update(Request $request, $id)
    {
        $persediaan = Persediaan::findOrFail($id);

        $validated = $request->validate([
            'id_barcode' => 'required|exists:barcode,id',
            'tipe' => 'required|in:masuk,keluar',
            'qty_produk' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        // Hitung ulang qty_sisa dari transaksi ini
        $previous = Persediaan::where('id_barcode', $validated['id_barcode'])
            ->where('id', '<', $persediaan->id)
            ->orderBy('tanggal', 'desc')
            ->first();

        $qty_sisa = $previous ? $previous->qty_sisa : 0;

        if ($validated['tipe'] === 'masuk') {
            $qty_sisa += $validated['qty_produk'];
        } else {
            $qty_sisa -= $validated['qty_produk'];
            $qty_sisa = max(0, $qty_sisa);
        }

        $validated['qty_sisa'] = $qty_sisa;

        $persediaan->update($validated);

        return redirect()->route('employee.persediaan.riwayat')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $persediaan = Persediaan::findOrFail($id);
        $persediaan->delete();

        return redirect()->route('employee.persediaan.riwayat')->with('success', 'Data berhasil dihapus.');
    }
}
