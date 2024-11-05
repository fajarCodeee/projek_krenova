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
        Schema::create('tb_parameter_indikator_opd', function (Blueprint $table) {
            $table->id();
            $table->foreignId('indikator_id')
                ->constrained('tb_indikator_opd')
                ->cascadeOnDelete();
            $table->string('parameter_ke');
            $table->text('paramater');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_parameter_indikator_opd');
    }
};
