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
        Schema::create('pokmil', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedInteger('pokmil_id')->unique();
            $table->string('nama');
            $table->year('tahun');
            $table->string('no_sk')->nullable();
            $table->string('alamat')->nullable();
            $table->string('satker_id')->references('id')->on('satuan_kerja');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokmil');
    }
};
