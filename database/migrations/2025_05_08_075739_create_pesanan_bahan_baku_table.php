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
        Schema::create('pesanan_bahan_baku', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_formulir_pemesanan_bahan_baku')->constrained('formulir_pemesanan_bahan_baku')->onDelete('cascade');
            $table->foreignId('id_karyawan')->constrained('karyawans')->onDelete('cascade');
            $table->foreignId('id_pemasok')->constrained('pemasoks')->onDelete('cascade');
            $table->enum('status', ['menunggu', 'diterima']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan_bahan_baku');
    }
};
