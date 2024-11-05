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
        Schema::create('index_indikator_opd', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('inovasi_id')
                ->constrained('form_inovasi_perangkat_daerahs')
                ->cascadeOnDelete();
            $table->foreignId('indikator_id')
                ->constrained('tb_indikator_opd')
                ->cascadeOnDelete();
            $table->foreignId('parameter_id')
                ->constrained('tb_parameter_indikator_opd')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('index_indikator_opd', function (Blueprint $table) {
            //
        });
    }
};
