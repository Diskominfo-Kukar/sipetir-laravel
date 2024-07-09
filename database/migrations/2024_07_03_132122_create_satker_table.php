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
        Schema::create('satuan_kerja', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedInteger('stk_id');
            $table->string('nama');
            $table->string('opd_id')->references('id')->on('opd');
            $table->text('alamat')->nullable();
            $table->text('telepon')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('satuan_kerja');
    }
};
