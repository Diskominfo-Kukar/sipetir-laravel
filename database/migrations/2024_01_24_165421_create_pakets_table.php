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
            $table->string('pokmil_id')->references('id')->on('pokmil')->nullable();
            $table->string('ppk_id')->references('id')->on('ppk')->nullable();
            $table->string('satker_id')->references('id')->on('satuan_kerja')->nullable();
            $table->char('kode')->nullable();
            $table->text('nama');
            $table->char('slug')->nullable();
            $table->decimal('pagu', '25', 2)->default(0);
            $table->decimal('hps', '25', 2)->default(0);
            $table->string('lokasi')->nullable();
            $table->year('tahun')->nullable();
            $table->text('uraian_pekerjaan')->nullable();
            $table->text('spesifikasi_pekerjaan')->nullable();
            $table->string('metode_pengadaan_id')->references('id')->on('metode_pengadaan')->nullable();
            $table->string('jenis_pengadaan_id')->references('id')->on('jenis_pengadaan')->nullable();
            $table->char('status', 2)->nullable()->comment('0: selesai, 1: upload, 2:verif , 3: pilihpokmil, 4: TTE1, 5: Review, 6: TTE2, 7: TTE3');
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
