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
        Schema::create('persediaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_barcode')->constrained('barcode')->onDelete('cascade');
            $table->enum('tipe', ['keluar', 'masuk']);
            $table->integer('qty_produk')->nullable();
            $table->date('tanggal')->nullable();
            $table->integer('qty_sisa')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persediaan');
    }
};
