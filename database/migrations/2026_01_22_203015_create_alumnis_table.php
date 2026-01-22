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
        Schema::create('alumnis', function (Blueprint $table) {
            $table->id();
            $table->string('program');
            $table->string('category');
            $table->string('year'); // Storing year as string as requested (e.g., '2025')
            $table->string('name');
            $table->date('dob');
            $table->text('address');
            $table->string('division');
            $table->string('email');
            $table->string('phone');
            $table->string('school')->nullable();
            $table->string('college')->nullable();
            $table->string('university')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->string('photo');
            $table->text('description'); // Not nullable as per update
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnis');
    }
};
