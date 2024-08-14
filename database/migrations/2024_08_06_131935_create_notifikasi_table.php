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
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id();
            $table->string('module_id');
            $table->string('module_class');
            $table->string('panitia_id')->references('id')->on('panitia');
            $table->string('type')->nullable();
            $table->text('message');
            $table->boolean('is_read')->default(false)->comment('0: belum dibaca, 1: dibaca');
            $table->string('target_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};
