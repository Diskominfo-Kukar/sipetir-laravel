<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jenis_pengadaan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('kode');
            $table->char('nama');
            $table->char('slug');
            $table->char('keterangan');
            $table->enum('status', ['aktif', 'tidak'])->default('aktif');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_pengadaan');
    }
};
