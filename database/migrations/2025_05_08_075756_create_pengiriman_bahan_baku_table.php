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
        Schema::create('pengiriman_bahan_baku', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pesanan_bahan_baku')->constrained('pesanan_bahan_baku')->onDelete('cascade');
            $table->foreignId('id_karyawan')->constrained('karyawans')->onDelete('cascade');
            $table->foreignId('id_pemasok')->constrained('pemasoks')->onDelete('cascade');
            $table->string('bukti_pengiriman')->nullable();
            $table->timestamp('estimasi_sampai')->nullable();
            $table->string('bukti_serah_terima')->nullable();
            $table->enum('status', ['dikirim', 'terlambat', 'diterima'])->default('dikirim');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengiriman_bahan_baku');
    }
};
