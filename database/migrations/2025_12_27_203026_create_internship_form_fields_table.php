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
        Schema::create('internship_form_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('internship_form_id')->constrained()->onDelete('cascade');
            $table->string('label');
            $table->string('field_name')->nullable();
            $table->string('type'); // text, date, radio, select, file
            $table->json('options')->nullable();
            $table->boolean('is_required')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internship_form_fields');
    }
};
