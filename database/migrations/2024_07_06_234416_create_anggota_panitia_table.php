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
        Schema::create('anggota_panitia', function (Blueprint $table) {
            $table->unsignedInteger('pnt_id');
            $table->foreign('pnt_id')->references('pnt_id')->on('panitia');
            $table->unsignedInteger('peg_id');
            $table->foreign('peg_id')->references('peg_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_panitia');
    }
};
