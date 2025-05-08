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
        Schema::create('list_order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pesanan_mako')->constrained('pesanan_mako')->onDelete('cascade');
            $table->integer('total_pesanan');
            $table->enum('status_produksi', ['antrian', 'diproses', 'selesai'])->default('antrian');
            $table->enum('status_pengiriman', ['dikirim', 'selesai'])->default('dikirim');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_order');
    }
};
