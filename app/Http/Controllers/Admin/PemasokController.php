<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemasok;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PemasokController extends Controller
{
    public function index()
    {
        $pemasoks = Pemasok::with('user')->get();
        return view('admin.pemasok.index', compact('pemasoks'));
    }

    public function create()
    {
        return view('admin.pemasok.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'nama_perusahaan' => 'required',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'pemasok',
            'password' => Hash::make($request->password),
        ]);

        $user->pemasok()->create([
            'nama_perusahaan' => $request->nama_perusahaan,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.pemasok.index')->with('success', 'Data pemasok berhasil ditambahkan.');
    }

    public function edit(Pemasok $pemasok)
    {
        return view('admin.pemasok.edit', compact('pemasok'));
    }

    public function update(Request $request, Pemasok $pemasok)
    {
        $pemasok->update($request->only(['nama_perusahaan', 'no_telp', 'alamat']));
        $pemasok->user->update($request->only(['name', 'email']));
        return redirect()->route('admin.pemasok.index')->with('success', 'Data pemasok diperbarui.');
    }

    public function destroy(Pemasok $pemasok)
    {
        $pemasok->user()->delete();
        return redirect()->route('admin.pemasok.index')->with('success', 'Data pemasok dihapus.');
    }
}
