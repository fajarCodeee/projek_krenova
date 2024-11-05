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
        Schema::table('tb_parameter_indikator_opd', function (Blueprint $table) {
            $table->renameColumn('paramater', 'parameter');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_parameter_indikator_opd', function (Blueprint $table) {
            //
        });
    }
};
