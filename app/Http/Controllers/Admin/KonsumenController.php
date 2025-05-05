<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konsumen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KonsumenController extends Controller
{
    public function index()
    {
        $konsumens = Konsumen::with('user')->get();
        return view('admin.konsumen.index', compact('konsumens'));
    }

    public function create()
    {
        return view('admin.konsumen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'konsumen',
            'password' => Hash::make($request->password),
        ]);

        $user->konsumen()->create([
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.konsumen.index')->with('success', 'Data konsumen berhasil ditambahkan.');
    }

    public function edit(Konsumen $konsuman)
    {
        return view('admin.konsumen.edit', compact('konsuman'));
    }

    public function update(Request $request, Konsumen $konsumen)
    {
        $konsumen->update($request->only(['no_telp', 'alamat']));
        $konsumen->user->update($request->only(['name', 'email']));
        return redirect()->route('admin.konsumen.index')->with('success', 'Data konsumen diperbarui.');
    }

    public function destroy(Konsumen $konsumen)
    {
        $konsumen->user()->delete();
        return redirect()->route('admin.konsumen.index')->with('success', 'Data konsumen dihapus.');
    }
}
