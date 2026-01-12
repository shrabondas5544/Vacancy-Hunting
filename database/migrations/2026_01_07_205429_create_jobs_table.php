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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description');
            $table->text('requirements')->nullable();
            $table->string('field_type'); // IT, Marketing, HR, etc.
            $table->string('job_type'); // Full Time, Part Time, Remote, Freelance, Internship
            $table->string('experience_level'); // Beginner, Intermediate, Experienced, Expert
            $table->string('location')->nullable();
            $table->string('division')->nullable(); // Bangladesh divisions
            $table->integer('vacancies')->nullable(); // Number of positions
            $table->string('salary_range')->nullable();
            $table->date('deadline');
            $table->text('educational_qualifications')->nullable();
            $table->text('experience')->nullable();
            $table->text('required_skills')->nullable(); // Comma-separated skills
            $table->text('job_benefits')->nullable();
            $table->enum('status', ['active', 'closed', 'draft'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
