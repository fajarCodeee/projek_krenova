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
        Schema::create('evaluasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('form_id')
                ->constrained('form_inovasi_perangkat_daerahs')
                ->cascadeOnDelete();
            $table->foreignId('kriteria_id')
                ->constrained('kriterias')
                ->cascadeOnDelete();
            $table->foreignId('kriteria_option_id')
                ->constrained('kriteria_options')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluasis');
    }
};
