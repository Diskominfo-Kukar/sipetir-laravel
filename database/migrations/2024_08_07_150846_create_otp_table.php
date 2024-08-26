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
        Schema::create('otp', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('module_id');
            $table->string('module_class');
            $table->string('panitia_id')->references('id')->on('panitia');
            $table->enum('type', ['wa', 'email'])->default('wa');
            $table->string('to')->nullable();
            $table->text('code');
            $table->unsignedTinyInteger('status')->default(1)->comment('0: gagal, 1: pending, 2: terkirim', '3: terpakai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otp');
    }
};
