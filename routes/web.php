<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\PemasokController;
use App\Http\Controllers\Admin\KonsumenController;
use App\Http\Controllers\AuthController;
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
        'konsumen' => redirect('/dashboard/konsumen'),
        default => abort(403),
    };
})->middleware('auth');

Route::prefix('/admin')->name('admin.')->group(function () {
    Route::resource('karyawan', KaryawanController::class);
    Route::resource('pemasok', PemasokController::class);
    Route::resource('konsumen', KonsumenController::class);
});
