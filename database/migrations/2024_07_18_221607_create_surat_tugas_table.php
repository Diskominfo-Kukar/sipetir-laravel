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
        Schema::create('surat_tugas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('kode')->nullable();
            $table->string('paket_id')->references('id')->on('paket')->nullable();
            $table->text('nama_paket')->nullable();
            $table->text('jenis_pekerjaan')->nullable();
            $table->text('nama_opd')->nullable();
            $table->text('sumber_dana')->nullable();
            $table->decimal('pagu', '25', 2)->default(0);
            $table->decimal('hps', '25', 2)->default(0);
            $table->text('dpa')->nullable();
            $table->integer('tahun')->nullable();
            $table->timestamps();
            $table->unique(['kode', 'tahun']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_tugas');
    }
};
