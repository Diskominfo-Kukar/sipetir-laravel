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
        Schema::create('answer_chrs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('paket_id');
            $table->string('kategori_id')->references('id')->on('kategori_review');
            $table->uuid('user_id');
            $table->text('review');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answer_chrs');
    }
};
