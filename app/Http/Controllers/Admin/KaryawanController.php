<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::with('user')->get();
        return view('admin.karyawan.index', compact('karyawans'));
    }

    public function create()
    {
        return view('admin.karyawan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'jabatan' => 'required|string|in:kepala_divisi,staf_pengadaan,staf_produksi,staf_logistik',
            'password' => 'required|string|min:6',
            'no_telp' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->jabatan,
            'password' => Hash::make($request->password),
        ]);

        $user->karyawan()->create([
            'no_telp' => $request->no_telp,
        ]);

        return redirect()->route('admin.karyawan.index')->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    public function edit(Karyawan $karyawan)
    {
        return view('admin.karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $karyawan->user_id,
            'jabatan' => 'required|string|in:kepala_divisi,staf_pengadaan,staf_produksi,staf_logistik',
            'no_telp' => 'nullable|string',
        ]);

        $karyawan->update([
            'no_telp' => $request->no_telp,
        ]);

        $karyawan->user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->jabatan,
        ]);

        return redirect()->route('admin.karyawan.index')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function destroy(Karyawan $karyawan)
    {
        $karyawan->user()->delete();
        return redirect()->route('admin.karyawan.index')->with('success', 'Data karyawan berhasil dihapus.');
    }
}
