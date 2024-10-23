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
        Schema::create('kriteria_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kriteria_id')
                ->constrained('kriterias')
                ->cascadeOnDelete();
            $table->text('option_text');
            $table->integer('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriteria_options');
    }
};
