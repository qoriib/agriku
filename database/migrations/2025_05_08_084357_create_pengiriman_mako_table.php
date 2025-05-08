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
        Schema::create('pengiriman_mako', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pesanan_mako')->constrained('pesanan_mako')->onDelete('cascade');
            $table->foreignId('id_konsumen')->constrained('konsumens')->onDelete('cascade');
            $table->foreignId('id_karyawan')->constrained('karyawans')->onDelete('cascade');
            $table->timestamp('estimasi_sampai');
            $table->string('bukti_pesanan_diterima');
            $table->enum('status', ['dikirim', 'diterima']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengiriman_mako');
    }
};
