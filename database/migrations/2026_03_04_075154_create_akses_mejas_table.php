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
        Schema::create('akses_mejas', function (Blueprint $table) {
            $table->id();
        $table->foreignId('penjualan_id')->constrained('penjualans')->cascadeOnDelete();
        $table->foreignId('management_meja_id')->constrained('management_mejas')->cascadeOnDelete();
        $table->decimal('jumlah', 12, 2);
        $table->string('gambar')->nullable(); 
        $table->string('status')->default('pending');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akses_mejas');
    }
};
