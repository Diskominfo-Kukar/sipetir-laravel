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
        Schema::create('question', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('nama');
            $table->text('slug');
            $table->char('no_urut')->nullable();
            $table->string('paket_id')->nullable();
            $table->string('parent_id')->nullable();
            $table->string('kategori_id')->references('id')->on('kategori_review');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question');
    }
};
