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
        Schema::create('sync_data_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->unsignedInteger('row_synced');
            $table->dateTime('last_synced');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sync_data_statuses');
    }
};
