<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/', [Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/', [Controllers\AuthController::class, 'login']);
});
Route::post('/logout', [Controllers\AuthController::class, 'logout'])->name('logout');

Route::get('/redirect-role', function () {
    return match (Auth::user()->role) {
        'kepala_divisi', 'staf_pengadaan', 'staf_produksi', 'staf_logistik' => redirect()->route('employee.barcode.index'),
        'pemasok' => redirect()->route('supplier.pesanan.index'),
        'konsumen' => redirect()->route('customer.mako.index'),
        'admin' => redirect()->route('admin.karyawan.index'),
        default => abort(403),
    };
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('karyawan', Controllers\Admin\KaryawanController::class);
    Route::resource('pemasok', Controllers\Admin\PemasokController::class);
    Route::resource('konsumen', Controllers\Admin\KonsumenController::class);
});

/*
|--------------------------------------------------------------------------
| Divisi Routes
|--------------------------------------------------------------------------
*/
Route::prefix('divisi')->middleware('auth')->name('divisi.')->group(function () {
    Route::controller(Controllers\Divisi\PesananMakoController::class)->group(function () {
        Route::get('pesanan', 'index')->name('pesanan.index');
        Route::put('pesanan/{id}', 'update')->name('pesanan.update');
        Route::delete('pesanan/{id}', 'destroy')->name('pesanan.destroy');
    });

    Route::controller(Controllers\Divisi\PembayaranMakoController::class)->group(function () {
        Route::get('pembayaran', 'index')->name('pembayaran.index');
        Route::get('pembayaran/{id}', 'show')->name('pembayaran.show');
        Route::put('pembayaran/{id}', 'update')->name('pembayaran.update');
        Route::delete('pembayaran/{id}', 'destroy')->name('pembayaran.destroy');
    });
});

/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
*/
Route::prefix('customer')->middleware('auth')->name('customer.')->group(function () {
    // Mako
    Route::controller(Controllers\Customer\PesananMakoController::class)->prefix('mako')->name('mako.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/edit/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
    });

    // Pembayaran
    Route::controller(Controllers\Customer\PembayaranMakoController::class)->prefix('pembayaran')->name('pembayaran.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/detail/{id}', 'show')->name('show');
        Route::get('/mako/{id}/pembayaran', 'create')->name('create');
        Route::post('/mako/{id}/pembayaran', 'store')->name('store');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
    });

    // Pengiriman
    Route::controller(Controllers\Customer\PengirimanMakoController::class)->group(function () {
        Route::get('/pengiriman', 'index')->name('pengiriman.index');
        Route::get('/konfirmasi/{id}', 'showKonfirmasi')->name('pengiriman.konfirmasi.form');
        Route::post('/konfirmasi/{id}', 'prosesKonfirmasi')->name('pengiriman.konfirmasi.submit');
    });
});

/*
|--------------------------------------------------------------------------
| Employee Routes
|--------------------------------------------------------------------------
*/
Route::prefix('employee')->middleware('auth')->name('employee.')->group(function () {

    // Barcode
    Route::controller(Controllers\Employee\BarcodeController::class)->prefix('barcode')->name('barcode.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/edit/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
    });

    // Pengadaan
    Route::controller(Controllers\Employee\PesananBahanBakuController::class)->prefix('pengadaan')->name('pengadaan.')->group(function () {
        Route::get('/pesanan', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/edit/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
    });

    // Pengiriman mako
    Route::controller(Controllers\Employee\PengirimanMakoController::class)->prefix('pengiriman')->name('pengiriman.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/edit/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
    });

    // Pengiriman bahan baku
    Route::controller(Controllers\Employee\PengirimanBahanBakuController::class)->prefix('pengiriman-bahan-baku')->name('pengiriman-bahanbaku.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::put('/status/{id}', 'updateStatus')->name('updateStatus');
    });

    // Persediaan
    Route::controller(Controllers\Employee\PersediaanController::class)->prefix('persediaan')->name('persediaan.')->group(function () {
        Route::get('/stok', 'stok')->name('stok');
        Route::get('/riwayat', 'riwayat')->name('riwayat');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/edit/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::get('/scan', 'scan')->name('scan');
    });

    // Pembayaran
    Route::controller(Controllers\Employee\PembayaranBahanBakuController::class)->prefix('pembayaran')->name('pembayaran.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/{pesanan_id}', 'create')->name('create');
        Route::post('/create/{pesanan_id}', 'store')->name('store');
        Route::get('/detail/{id}', 'show')->name('show');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/edit/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
    });
});

/*
|--------------------------------------------------------------------------
| Supplier Routes
|--------------------------------------------------------------------------
*/
Route::prefix('supplier')->middleware('auth')->name('supplier.')->group(function () {

    // Pesanan
    Route::controller(Controllers\Supplier\PesananBahanBakuController::class)->prefix('pesanan')->name('pesanan.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/edit/{id}', 'update')->name('update');
        Route::put('/edit-status/{id}', 'updateStatus')->name('updateStatus');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
    });

    // Pembayaran
    Route::controller(Controllers\Supplier\PembayaranBahanBakuController::class)->prefix('pembayaran')->name('pembayaran.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/edit/{id}', 'update')->name('update');
    });

    // Pengiriman
    Route::controller(Controllers\Supplier\PengirimanBahanBakuController::class)->prefix('pengiriman')->name('pengiriman.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/{pesananId}', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/edit/{id}', 'update')->name('update');
    });
});
