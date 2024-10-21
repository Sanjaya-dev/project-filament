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
        Schema::create('kontens', function (Blueprint $table) {
            $table->id();
            $table->json('nama'); // Menyimpan lebih dari satu nama
            $table->foreignId('jenis_kejahatan_id')->constrained('jenis_kejahatan'); // Relasi ke jenis kejahatan
            $table->json('peneliti'); // Menyimpan lebih dari satu nama peneliti
            $table->date('tanggal_SPDP')->nullable();
            $table->date('tanggal_P17')->nullable();
            $table->date('tanggal_tahap_I')->nullable();
            $table->date('tanggal_P18')->nullable();
            $table->date('tanggal_P19')->nullable();
            $table->date('tanggal_P20')->nullable();
            $table->date('tanggal_P21')->nullable();
            $table->date('tanggal_P21A')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontens');
    }
};
