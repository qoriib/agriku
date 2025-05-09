<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\PemasokController;
use App\Http\Controllers\Admin\KonsumenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Customer\PembayaranMakoController;
use App\Http\Controllers\Employee\PesananBahanBakuController;
use App\Http\Controllers\Customer\PesananMakoController;
use App\Http\Controllers\Employee\BarcodeController;
use App\Http\Controllers\Employee\PengirimanMakoController;
use App\Http\Controllers\Employee\PersediaanController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Divisi\PesananMakoController as DivisiPesananMakoController;
use App\Http\Controllers\Divisi\PembayaranMakoController as DivisiPembayaranMakoController;
use App\Http\Controllers\Employee\PembayaranBahanBakuController;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/redirect-role', function () {
    $user = Auth::user();
    $role = $user->role;

    return match ($role) {
        'admin' => redirect()->route('admin.karyawan.index'),
        'kepala_divisi',
        'staf_pengadaan',
        'staf_produksi',
        'staf_logistik' => redirect()->route('employee.barcode.index'),
        'pemasok' => redirect()->route('supplier.pesanan.index'),
        'konsumen' => redirect()->route('customer.mako.index'),
        default => abort(403, 'Peran tidak dikenali'),
    };
})->middleware('auth');

Route::prefix('/admin')->name('admin.')->group(function () {
    Route::resource('karyawan', KaryawanController::class);
    Route::resource('pemasok', PemasokController::class);
    Route::resource('konsumen', KonsumenController::class);
});

Route::prefix('divisi')->middleware('auth')->group(function () {
    Route::get('/pesanan', [DivisiPesananMakoController::class, 'index'])->name('divisi.pesanan.index');
    Route::put('/pesanan/{id}', [DivisiPesananMakoController::class, 'update'])->name('divisi.pesanan.update');
    Route::delete('/pesanan/{id}', [DivisiPesananMakoController::class, 'destroy'])->name('divisi.pesanan.destroy');

    Route::get('/pembayaran', [DivisiPembayaranMakoController::class, 'index'])->name('divisi.pembayaran.index');
    Route::get('/pembayaran/{id}', [DivisiPembayaranMakoController::class, 'show'])->name('divisi.pembayaran.show');
    Route::put('/pembayaran/{id}', [DivisiPembayaranMakoController::class, 'update'])->name('divisi.pembayaran.update');
    Route::delete('/pembayaran/{id}', [DivisiPembayaranMakoController::class, 'destroy'])->name('divisi.pembayaran.destroy');
});

Route::prefix('customer/mako')->middleware('auth')->group(function () {
    Route::get('/', [PesananMakoController::class, 'index'])->name('customer.mako.index');
    Route::get('/create', [PesananMakoController::class, 'create'])->name('customer.mako.create');
    Route::post('/create', [PesananMakoController::class, 'store'])->name('customer.mako.store');
    Route::get('/edit/{id}', [PesananMakoController::class, 'edit'])->name('customer.mako.edit');
    Route::put('/edit/{id}', [PesananMakoController::class, 'update'])->name('customer.mako.update');
    Route::delete('/delete/{id}', [PesananMakoController::class, 'destroy'])->name('customer.mako.destroy');
});

Route::prefix('customer/pembayaran')->middleware(['auth'])->group(function () {
    Route::get('/', [PembayaranMakoController::class, 'index'])->name('customer.pembayaran.index');
    Route::get('/detail/{id}', [PembayaranMakoController::class, 'show'])->name('customer.pembayaran.show');
    Route::get('/mako/{id}/pembayaran', [PembayaranMakoController::class, 'create'])->name('customer.pembayaran.create');
    Route::post('/mako/{id}/pembayaran', [PembayaranMakoController::class, 'store'])->name('customer.pembayaran.store');
    Route::delete('/delete/{id}', [PembayaranMakoController::class, 'destroy'])->name('customer.pembayaran.destroy');
});

Route::prefix('customer')->middleware(['auth'])->group(function () {
    Route::get('/pengiriman', [\App\Http\Controllers\Customer\PengirimanMakoController::class, 'index'])->name('customer.pengiriman.index');
    Route::get('/konfirmasi/{id}', [\App\Http\Controllers\Customer\PengirimanMakoController::class, 'showKonfirmasi'])->name('customer.pengiriman.konfirmasi.form');
    Route::post('/konfirmasi/{id}', [\App\Http\Controllers\Customer\PengirimanMakoController::class, 'prosesKonfirmasi'])->name('customer.pengiriman.konfirmasi.submit');
});

Route::prefix('employee/barcode')->middleware('auth')->group(function () {
    Route::get('/', [BarcodeController::class, 'index'])->name('employee.barcode.index');
    Route::get('/create', [BarcodeController::class, 'create'])->name('employee.barcode.create');
    Route::post('/create', [BarcodeController::class, 'store'])->name('employee.barcode.store');
    Route::get('/edit/{id}', [BarcodeController::class, 'edit'])->name('employee.barcode.edit');
    Route::put('/edit/{id}', [BarcodeController::class, 'update'])->name('employee.barcode.update');
    Route::delete('/delete/{id}', [BarcodeController::class, 'destroy'])->name('employee.barcode.destroy');
});

Route::prefix('employee/pengadaan')->middleware('auth')->group(function () {
    Route::get('/pesanan', [PesananBahanBakuController::class, 'index'])->name('employee.pengadaan.index');
    Route::get('/create', [PesananBahanBakuController::class, 'create'])->name('employee.pengadaan.create');
    Route::post('/create', [PesananBahanBakuController::class, 'store'])->name('employee.pengadaan.store');
    Route::get('/edit/{id}', [PesananBahanBakuController::class, 'edit'])->name('employee.pengadaan.edit');
    Route::put('/edit/{id}', [PesananBahanBakuController::class, 'update'])->name('employee.pengadaan.update');
    Route::delete('/delete/{id}', [PesananBahanBakuController::class, 'destroy'])->name('employee.pengadaan.destroy');
});

Route::prefix('employee/pengiriman')->middleware('auth')->group(function () {
    Route::get('/', [PengirimanMakoController::class, 'index'])->name('employee.pengiriman.index');
    Route::get('/create', [PengirimanMakoController::class, 'create'])->name('employee.pengiriman.create');
    Route::post('/create', [PengirimanMakoController::class, 'store'])->name('employee.pengiriman.store');
    Route::get('/edit/{id}', [PengirimanMakoController::class, 'edit'])->name('employee.pengiriman.edit');
    Route::put('/edit/{id}', [PengirimanMakoController::class, 'update'])->name('employee.pengiriman.update');
    Route::delete('/delete/{id}', [PengirimanMakoController::class, 'destroy'])->name('employee.pengiriman.destroy');
});

Route::prefix('employee/persediaan')->middleware('auth')->group(function () {
    Route::get('/stok', [PersediaanController::class, 'stok'])->name('employee.persediaan.stok');
    Route::get('/riwayat', [PersediaanController::class, 'riwayat'])->name('employee.persediaan.riwayat');
    Route::get('/create', [PersediaanController::class, 'create'])->name('employee.persediaan.create');
    Route::post('/create', [PersediaanController::class, 'store'])->name('employee.persediaan.store');
    Route::get('/edit/{id}', [PersediaanController::class, 'edit'])->name('employee.persediaan.edit');
    Route::put('/edit/{id}', [PersediaanController::class, 'update'])->name('employee.persediaan.update');
    Route::delete('/delete/{id}', [PersediaanController::class, 'destroy'])->name('employee.persediaan.destroy');
});

Route::prefix('employee/pembayaran')->middleware('auth')->group(function () {
    Route::get('/', [PembayaranBahanBakuController::class, 'index'])->name('employee.pembayaran.index');
    Route::get('/create/{pesanan_id}', [PembayaranBahanBakuController::class, 'create'])->name('employee.pembayaran.create');
    Route::post('/create/{pesanan_id}', [PembayaranBahanBakuController::class, 'store'])->name('employee.pembayaran.store');
    Route::get('/detail/{id}', [PembayaranBahanBakuController::class, 'show'])->name('employee.pembayaran.show');
    Route::get('/edit/{id}', [PembayaranBahanBakuController::class, 'edit'])->name('employee.pembayaran.edit');
    Route::put('/edit/{id}', [PembayaranBahanBakuController::class, 'update'])->name('employee.pembayaran.update');
    Route::delete('/delete/{id}', [PembayaranBahanBakuController::class, 'destroy'])->name('employee.pembayaran.destroy');
});

Route::prefix('supplier/pesanan')->middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\Supplier\PesananBahanBakuController::class, 'index'])->name('supplier.pesanan.index');
    Route::get('/edit/{id}', [App\Http\Controllers\Supplier\PesananBahanBakuController::class, 'edit'])->name('supplier.pesanan.edit');
    Route::put('/edit/{id}', [App\Http\Controllers\Supplier\PesananBahanBakuController::class, 'update'])->name('supplier.pesanan.update');
    Route::put('/edit-status/{id}', [App\Http\Controllers\Supplier\PesananBahanBakuController::class, 'updateStatus'])->name('supplier.pesanan.updateStatus');
    Route::delete('/delete/{id}', [App\Http\Controllers\Supplier\PesananBahanBakuController::class, 'destroy'])->name('supplier.pesanan.destroy');
});

Route::prefix('supplier/pembayaran')->middleware('auth')->group(function () {
    Route::get('/', [\App\Http\Controllers\Supplier\PembayaranBahanBakuController::class, 'index'])->name('supplier.pembayaran.index');
    Route::get('/edit/{id}', [\App\Http\Controllers\Supplier\PembayaranBahanBakuController::class, 'edit'])->name('supplier.pembayaran.edit');
    Route::put('/edit/{id}', [\App\Http\Controllers\Supplier\PembayaranBahanBakuController::class, 'update'])->name('supplier.pembayaran.update');
});
