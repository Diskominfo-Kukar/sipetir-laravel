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
        Schema::create('dokumen_komen', function (Blueprint $table) {
            $table->uuid('paket_dokumen_id');
            $table->unsignedBigInteger('komen_id');

            $table->foreign('paket_dokumen_id')->references('id')->on('paket_dokumen')->onDelete('cascade');
            $table->foreign('komen_id')->references('id')->on('komens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_komen');
    }
};
