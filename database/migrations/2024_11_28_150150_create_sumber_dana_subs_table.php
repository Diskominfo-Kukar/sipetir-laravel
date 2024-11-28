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
        Schema::create('sumber_dana_subs', function (Blueprint $table) {
            $table->id();
            $table->string('sumber_dana_id');
            $table->string('nama');
            $table->timestamps();

            $table->foreign('sumber_dana_id')->references('id')->on('sumber_dana')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sumber_dana_subs');
    }
};
