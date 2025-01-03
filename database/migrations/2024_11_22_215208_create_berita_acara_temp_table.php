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
        Schema::create('berita_acara_temp', function (Blueprint $table) {
            $table->id();
            $table->uuid('paket_id');
            $table->uuid('panitia_id');
            $table->string('nip')->nullable();
            $table->string('passphrase')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita_acara_temp');
    }
};
