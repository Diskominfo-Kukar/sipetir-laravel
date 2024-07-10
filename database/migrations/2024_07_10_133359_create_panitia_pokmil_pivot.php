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
        Schema::create('panitia_pokmil_pivot', function (Blueprint $table) {
            $table->string('pokmil_id')->references('id')->on('pokmil');
            $table->string('panitia_id')->references('id')->on('panitia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panitia_pokmil_pivot');
    }
};
