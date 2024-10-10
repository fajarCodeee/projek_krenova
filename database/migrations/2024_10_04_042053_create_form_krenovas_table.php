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
        Schema::create('form_krenovas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('innovation_title')->nullable();
            $table->string('competition_category')->nullable();
            $table->string('participant_category')->nullable();
            $table->text('abstract')->nullable();
            $table->text('innovation_excellence')->nullable();
            $table->text('benefits_of_innovation')->nullable();
            $table->text('applications_to_society')->nullable();
            $table->string('link_video_innovation')->nullable();
            $table->enum('status', ['1', '2', '3'])->default('1');
            $table->text('information')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_krenovas');
    }
};
