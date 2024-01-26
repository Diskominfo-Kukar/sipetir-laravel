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
        Schema::create('opd', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('kode');
            $table->char('kode_str');
            $table->char('nama');
            $table->char('slug');
            $table->enum('status', ['aktif', 'tidak'])->default('aktif');
            $table->string('jenis_opd_id')->references('id')->on('jenis_opd');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opd');
    }
};
