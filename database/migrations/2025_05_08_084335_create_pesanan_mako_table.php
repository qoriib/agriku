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
        Schema::create('pesanan_mako', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_formulir_pemesanan_mako')->constrained('formulir_pemesanan_mako')->onDelete('cascade');
            $table->foreignId('id_konsumen')->constrained('konsumens')->onDelete('cascade');
            $table->enum('status', ['menunggu', 'diterima']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan_mako');
    }
};
