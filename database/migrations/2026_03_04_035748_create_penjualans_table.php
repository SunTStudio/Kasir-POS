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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('no_pesanan')->unique();
            $table->string('nama_pemesan')->nullable();
            $table->string('no_telp')->nullable();

            $table->foreignId('jenis_id')->constrained('jenis')->cascadeOnDelete();
            $table->foreignId('meja_id')->nullable()->constrained('management_mejas')->nullOnDelete();

            $table->dateTime('tanggal_pemesanan');
            $table->integer('jumlah_orang')->nullable();

            $table->string('status')->default('pending'); // pending/cooking/served/paid/cancelled
            $table->dateTime('tanggal_penjualan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
