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
        Schema::create('verifikasi_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_log')->constrained('log_harian')->onDelete('cascade');
            $table->foreignId('id_verifikator')->constrained('pegawai')->onDelete('cascade');
            $table->string('status_verifikasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifikasi_logs');
    }
};
