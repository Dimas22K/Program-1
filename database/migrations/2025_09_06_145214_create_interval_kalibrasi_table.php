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
        Schema::create('interval_kalibrasi', function (Blueprint $table) {
    $table->id();
    $table->string('nama_alat')->unique();
    $table->integer('interval_bulan'); // contoh: 6 bulan, 12 bulan, dst
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interval_kalibrasi');
    }
};
