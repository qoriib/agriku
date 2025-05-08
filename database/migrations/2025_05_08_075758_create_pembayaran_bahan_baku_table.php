<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembayaran_bahan_baku', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pesanan_bahan_baku')->constrained('pesanan_bahan_baku')->onDelete('cascade');
            $table->foreignId('id_karyawan')->constrained('karyawans')->onDelete('cascade');
            $table->string('no_rekening_penerima');
            $table->string('nama_bank_penerima');
            $table->string('nama_pengirim');
            $table->string('nama_bank_pengirim');
            $table->string('bukti_pembayaran');
            $table->enum('status', ['menunggu pembayaran', 'lunas']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_bahan_baku');
    }
};
