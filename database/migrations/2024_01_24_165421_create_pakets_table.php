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
        Schema::create('paket', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('kode');
            $table->char('nama');
            $table->char('slug');
            $table->year('tahun');
            $table->integer('pagu')->default(0);
            $table->text('urarian_pekerjaan')->nullable();
            $table->text('spesifikasi_pekerjaan')->nullable();
            $table->string('metode_pengadaan_id')->references('id')->on('metode_pengadaan');
            $table->string('jenis_pengadaan_id')->references('id')->on('jenis_pengadaan');
            $table->string('ppk_id')->references('id')->on('ppk');
            $table->string('opd_id')->references('id')->on('opd');
            $table->char('status', 1)->nullable()->comment('0: selesai, 1: upload, 2:verif , 3: pilihpokmil, 4: TTE1, 5: Review, 6: TTE2, 7: TTE3');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket');
    }
};
