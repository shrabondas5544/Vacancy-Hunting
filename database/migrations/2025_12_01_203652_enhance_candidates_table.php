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
        Schema::table('candidates', function (Blueprint $table) {
            // Professional Summary
            $table->text('professional_summary')->nullable()->after('skills');
            
            // Contact Information
            $table->string('phone', 20)->nullable()->after('professional_summary');
            
            // Address Fields
            $table->string('street')->nullable()->after('phone');
            $table->string('city')->nullable()->after('street');
            $table->string('state')->nullable()->after('city');
            $table->string('zip_code', 20)->nullable()->after('state');
            $table->string('country')->nullable()->after('zip_code');
            
            // Personal Details
            $table->date('date_of_birth')->nullable()->after('country');
            $table->string('gender', 50)->nullable()->after('date_of_birth');
            $table->string('pronouns', 50)->nullable()->after('gender');
            
            // Social Media & Professional Links
            $table->string('linkedin_url')->nullable()->after('pronouns');
            $table->string('github_url')->nullable()->after('linkedin_url');
            $table->string('portfolio_url')->nullable()->after('github_url');
            $table->string('twitter_url')->nullable()->after('portfolio_url');
            $table->string('facebook_url')->nullable()->after('twitter_url');
            $table->string('instagram_url')->nullable()->after('facebook_url');
            
            // Hero Banner
            $table->string('hero_banner')->nullable()->after('profile_picture');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->dropColumn([
                'professional_summary',
                'phone',
                'street',
                'city',
                'state',
                'zip_code',
                'country',
                'date_of_birth',
                'gender',
                'pronouns',
                'linkedin_url',
                'github_url',
                'portfolio_url',
                'twitter_url',
                'facebook_url',
                'instagram_url',
                'hero_banner'
            ]);
        });
    }
};
