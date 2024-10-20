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
        Schema::create('form_inovasi_perangkat_daerahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('innovation_name');
            $table->enum('stage_of_innovation', ['uji-coba', 'penerapan', 'inisiatif']);
            $table->enum('regional_innovation_initiator', ['kepala', 'opd', 'asn', 'dprd', 'masyarakat']);
            $table->enum('type_of_innovation', ['digital', 'non-digital']);
            $table->enum('forms_of_regional_innovation', ['tata-kelola', 'pelayanan-publik', 'bentuk-lainnya']);
            $table->enum('thematic', ['digitalisasi-layanan-pemerintahan', 'penanggulangan-kemiskinan', 'kemudahan-investasi', 'prioritas-aktual-presiden', 'non-tematik']);
            $table->date('trial_time');
            $table->date('implementation_time');
            $table->text('plan_wake');
            $table->text('goals');
            $table->text('benefits');
            $table->text('result');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_inovasi_perangkat_daerahs');
    }
};
