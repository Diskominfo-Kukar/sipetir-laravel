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
        Schema::create('paket', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('nama');
            $table->char('slug');
            $table->year('tahun');
            $table->year('pagu');
            $table->string('panitia_id')->references('id')->on('panitia');
            $table->string('opd_id')->references('id')->on('opd');
            $table->char('status', 1)->nullable()->comment('0: draft, 1: selesai, 2: review, 3: dibikin ulang');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket');
    }
};