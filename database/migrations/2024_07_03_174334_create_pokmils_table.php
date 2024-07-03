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
        Schema::create('pokmils', function (Blueprint $table) {
            $table->id();
            $table->uuid('panitia_id');
            $table->timestamps();
            $table->foreign('panitia_id')->references('id')->on('panitia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokmils');
    }
};
