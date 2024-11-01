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
        Schema::create('paket_dokumen', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('paket_id')->nullable()->references('id')->on('paket')->onDelete('cascade');
            $table->string('jenis_dokumen_id')->nullable()->references('id')->on('jenis_dokumen')->onDelete('cascade');
            $table->text('file');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_dokumen');
    }
};
