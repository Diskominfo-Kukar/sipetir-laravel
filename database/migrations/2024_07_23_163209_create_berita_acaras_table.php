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
        if (! Schema::hasTable('berita_acara')) {
            Schema::create('berita_acara', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->integer('kode')->nullable();
                $table->string('paket_id')->references('id')->on('paket')->nullable();
                $table->text('nama_paket')->nullable();
                $table->text('jenis_pekerjaan')->nullable();
                $table->text('nama_opd')->nullable();
                $table->text('satker')->nullable();
                $table->text('sumber_dana')->nullable();
                $table->text('sumber_dana_sub')->nullable();
                $table->decimal('pagu', '25', 2)->default(0);
                $table->decimal('hps', '25', 2)->default(0);
                $table->text('dpa')->nullable();
                $table->integer('tahun')->nullable();
                $table->text('lokasi')->nullable();
                $table->text('lokasi_ba')->nullable();
                $table->text('jam_mulai')->nullable();
                $table->text('jam_berakhir')->nullable();
                $table->text('Intro')->nullable();
                $table->timestamps();
                $table->unique(['kode', 'tahun']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita_acaras');
    }
};
