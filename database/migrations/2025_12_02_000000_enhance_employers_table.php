<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employers', function (Blueprint $table) {
            // Address breakdown
            $table->string('street')->nullable()->after('company_address');
            $table->string('city')->nullable()->after('street');
            $table->string('state')->nullable()->after('city');
            $table->string('zip_code')->nullable()->after('state');
            $table->string('country')->nullable()->after('zip_code');
            
            // Company information
            $table->text('mission_statement')->nullable()->after('company_description');
            $table->text('vision_statement')->nullable()->after('mission_statement');
            $table->json('company_values')->nullable()->after('vision_statement');
            $table->text('products_services')->nullable()->after('company_values');
            $table->json('company_history')->nullable()->after('products_services');
            
            // Social media links
            $table->string('linkedin_url')->nullable()->after('website_url');
            $table->string('twitter_url')->nullable()->after('linkedin_url');
            $table->string('facebook_url')->nullable()->after('twitter_url');
            $table->string('instagram_url')->nullable()->after('facebook_url');
            $table->string('youtube_url')->nullable()->after('instagram_url');
            
            // Employee benefits
            $table->json('employee_benefits')->nullable()->after('youtube_url');
            
            // Visual assets
            $table->string('hero_banner')->nullable()->after('profile_picture');
        });
    }

    public function down(): void
    {
        Schema::table('employers', function (Blueprint $table) {
            $table->dropColumn([
                'street', 'city', 'state', 'zip_code', 'country',
                'mission_statement', 'vision_statement', 'company_values',
                'products_services', 'company_history',
                'linkedin_url', 'twitter_url', 'facebook_url', 'instagram_url', 'youtube_url',
                'employee_benefits', 'hero_banner'
            ]);
        });
    }
};
