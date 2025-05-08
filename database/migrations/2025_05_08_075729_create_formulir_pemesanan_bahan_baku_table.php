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
        Schema::create('formulir_pemesanan_bahan_baku', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pemesanan_bahan_baku');
            $table->string('nama_bahan_baku');
            $table->integer('qty');
            $table->date('tanggal_pemesanan');
            $table->text('alamat_pengiriman');
            $table->decimal('harga', 10, 2);
            $table->decimal('pajak', 10, 2);
            $table->decimal('total_harga', 10, 2);
            $table->foreignId('id_karyawan')->constrained('karyawans')->onDelete('cascade');
            $table->foreignId('id_pemasok')->constrained('pemasoks')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formulir_pemesanan_bahan_baku');
    }
};
