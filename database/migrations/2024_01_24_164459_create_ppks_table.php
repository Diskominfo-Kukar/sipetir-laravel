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
        Schema::create('ppk', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('nik')->nullable();
            $table->char('nip')->nullable();
            $table->char('slug');
            $table->char('nama');
            $table->string('user_id')->references('id')->on('users');
            $table->string('jabatan_id')->references('id')->on('jabatan');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppk');
    }
};
