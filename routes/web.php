<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\PemasokController;
use App\Http\Controllers\Admin\KonsumenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Customer\PesananBahanBakuController;
use App\Http\Controllers\Customer\PesananMakoController;
use Illuminate\Support\Facades\Auth;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/redirect-role', function () {
    $role = Auth::user()->role;

    return match ($role) {
        'admin' => redirect()->route('admin.karyawan.index'),
        'karyawan' => redirect('/dashboard/karyawan'),
        'pemasok' => redirect('/dashboard/pemasok'),
        'konsumen' => redirect()->route('customer.mako.index'),
        default => abort(403),
    };
})->middleware('auth');

Route::prefix('/admin')->name('admin.')->group(function () {
    Route::resource('karyawan', KaryawanController::class);
    Route::resource('pemasok', PemasokController::class);
    Route::resource('konsumen', KonsumenController::class);
});

Route::prefix('customer/mako')->middleware('auth')->group(function () {
    // Menampilkan daftar pesanan Mako konsumen
    Route::get('/', [PesananMakoController::class, 'index'])->name('customer.mako.index');

    // Menampilkan formulir untuk membuat pemesanan Mako
    Route::get('/create', [PesananMakoController::class, 'create'])->name('customer.mako.create');

    // Menyimpan pemesanan Mako
    Route::post('/create', [PesananMakoController::class, 'store'])->name('customer.mako.store');

    // Menampilkan detail pesanan Mako
    Route::get('/detail/{id}', [PesananMakoController::class, 'show'])->name('customer.mako.show');

    // Menampilkan form untuk mengedit pesanan Mako
    Route::get('/edit/{id}', [PesananMakoController::class, 'edit'])->name('customer.mako.edit');

    // Mengupdate pesanan Mako
    Route::put('/edit/{id}', [PesananMakoController::class, 'update'])->name('customer.mako.update');

    // Menghapus pesanan Mako
    Route::delete('/delete/{id}', [PesananMakoController::class, 'destroy'])->name('customer.mako.destroy');
});

Route::prefix('employee/order')->middleware('auth')->group(function () {
    Route::get('/', [PesananBahanBakuController::class, 'index'])->name('customer.order.index');
    Route::get('/create', [PesananBahanBakuController::class, 'create'])->name('customer.order.create');
    Route::post('create', [PesananBahanBakuController::class, 'store'])->name('customer.order.store');
    Route::get('/detail/{id}', [PesananBahanBakuController::class, 'show'])->name('customer.order.show');
    Route::get('/detail/payment-status/{id}', [PesananBahanBakuController::class, 'showPaymentStatus'])->name('customer.order.paymentStatus');
});
