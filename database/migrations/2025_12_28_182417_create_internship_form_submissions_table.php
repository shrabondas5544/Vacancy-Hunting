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
        Schema::create('internship_form_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('internship_form_id')->constrained()->onDelete('cascade');
            $table->string('applicant_name')->nullable();
            $table->string('applicant_email')->nullable();
            $table->string('applicant_phone')->nullable();
            $table->enum('status', ['pending', 'shortlisted', 'rejected'])->default('pending');
            $table->json('form_data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internship_form_submissions');
    }
};
