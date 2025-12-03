<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Base Users Table (Handles Login)
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            // Role can be: 'admin', 'candidate', 'employer'
            $table->enum('role', ['admin', 'candidate', 'employer']);
            $table->timestamps();
        });

        // 2. Candidates Table
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->integer('experience_years')->nullable();
            $table->text('skills')->nullable(); // stored as comma separated or JSON
            $table->json('interested_in')->nullable(); // e.g., ["full_time", "remote"]
            $table->timestamps();
        });

        // 3. Employers Table
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('company_name');
            $table->string('company_type')->nullable(); // IT, Marketing, etc.
            $table->string('contact_number')->nullable();
            $table->text('company_description')->nullable();
            $table->year('establishment_year')->nullable();
            $table->enum('company_ownership', ['private', 'public'])->nullable();
            $table->enum('employee_count', ['1-20', '20-50', '50-100', '100-300', '300-1000', '1000+'])->nullable();
            $table->text('company_address')->nullable();
            $table->string('trade_license_no')->nullable();
            $table->string('website_url')->nullable();
            // Status: 'pending' (default), 'approved', 'rejected'
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
        
        // 4. Admins Table (Optional, for admin specific data)
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admins');
        Schema::dropIfExists('employers');
        Schema::dropIfExists('candidates');
        Schema::dropIfExists('users');
    }
};