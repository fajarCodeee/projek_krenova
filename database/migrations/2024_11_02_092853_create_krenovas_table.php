<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('krenova', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->string('kode');
            $table->string('judul_inovasi');
            $table->string('kategori_lomba');
            $table->string('kategori_peserta');
            $table->text('abstrak');
            $table->text('keunggulan_inovasi');
            $table->text('manfaat_inovasi');
            $table->text('penerapan_pada_masyarakat');
            $table->text('link_video_inovasi')->nullable();
            $table->enum('status', ['draft', 'submitted', 'pending', 'aborted', 'need_recap'])
                ->default('draft');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('krenova');
    }
};
