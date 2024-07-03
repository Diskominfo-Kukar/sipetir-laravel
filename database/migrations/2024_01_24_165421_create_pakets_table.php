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
            $table->string('pkt_id');
            $table->char('kode')->nullable();
            $table->text('nama');
            $table->char('slug')->nullable();
            $table->year('tahun')->nullable();
            $table->decimal('pagu', 30, 2)->default(0);
            $table->text('urarian_pekerjaan')->nullable();
            $table->text('spesifikasi_pekerjaan')->nullable();
            $table->string('metode_pengadaan_id')->nullable()->references('id')->on('metode_pengadaan');
            $table->string('jenis_pengadaan_id')->nullable()->references('id')->on('jenis_pengadaan');
            $table->string('ppk_id')->nullable()->references('id')->on('ppk');
            $table->string('opd_id')->nullable()->references('id')->on('opd');
            $table->char('status', 1)->nullable()->comment('0: draft, 1: selesai, 2: review, 3: dibikin ulang');
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
