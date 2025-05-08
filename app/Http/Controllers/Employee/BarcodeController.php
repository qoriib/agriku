<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Barcode;
use Illuminate\Http\Request;

class BarcodeController extends Controller
{
    public function index()
    {
        $barcodes = Barcode::all();
        return view('employee.barcode.index', compact('barcodes'));
    }

    public function create()
    {
        return view('employee.barcode.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_produk' => 'required|unique:barcode,kode_produk',
            'nama_produk' => 'required|string',
            'satuan' => 'required|string',
            'kategori_produk' => 'required|in:barang jadi,bahan baku,bahan pendukung',
            'gudang' => 'required|in:gudang1,gudang2,gudang3',
        ]);

        Barcode::create($validated);

        return redirect()->route('employee.barcode.index')->with('success', 'Data barcode berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $barcode = Barcode::findOrFail($id);
        return view('employee.barcode.edit', compact('barcode'));
    }

    public function update(Request $request, $id)
    {
        $barcode = Barcode::findOrFail($id);

        $validated = $request->validate([
            'kode_produk' => 'required|unique:barcode,kode_produk,' . $barcode->id,
            'nama_produk' => 'required|string',
            'satuan' => 'required|string',
            'kategori_produk' => 'required|in:barang jadi,bahan baku,bahan pendukung',
            'gudang' => 'required|in:gudang1,gudang2,gudang3',
        ]);

        $barcode->update($validated);

        return redirect()->route('employee.barcode.index')->with('success', 'Data barcode berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $barcode = Barcode::findOrFail($id);
        $barcode->delete();

        return redirect()->route('employee.barcode.index')->with('success', 'Data barcode berhasil dihapus.');
    }
}
