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
            $table->text('code');
            $table->unsignedTinyInteger('type')->comment('1: wa, 2: email');
            $table->boolean('status')->default(1)->comment('0: gagal, 1: pending, 2: terkirim');
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
