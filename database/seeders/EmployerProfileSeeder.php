<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Employer;
use App\Models\EmployerLocation;
use App\Models\EmployerTeamMember;

class EmployerProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create the User Account
        $user = User::firstOrCreate(
            ['email' => 'hr@talentbridge.com'],
            [
                'password' => Hash::make('12345678'),
                'role' => 'employer',
            ]
        );

        // 2. Create the Employer Profile
        $employer = Employer::create([
            'user_id' => $user->id,
            'company_name' => 'TalentBridge HR Solutions',
            'company_type' => 'Public Limited Company',
            'contact_number' => '+8801855667788',
            'company_description' => "Bangladesh's premier HR consultancy and recruitment agency, connecting top talent with leading organizations since 2015.",
            'establishment_year' => 2015,
            'company_ownership' => 'public',
            'employee_count' => '100-300',
            'company_address' => 'Gulshan-2, Dhaka, Bangladesh',
            'street' => '55 Gulshan Avenue',
            'city' => 'Dhaka',
            'state' => 'Dhaka',
            'zip_code' => '1212',
            'country' => 'Bangladesh',
            'trade_license_no' => 'TRAD-HR-2015-98765',
            'website_url' => 'https://talentbridge.com.bd',
            'status' => 'approved',
            'approved_at' => now(),
            
            // Social Media
            'linkedin_url' => 'https://linkedin.com/company/talentbridge-hr',
            'twitter_url' => 'https://twitter.com/talentbridgebd',
            'facebook_url' => 'https://facebook.com/talentbridgehrbd',
            'instagram_url' => 'https://instagram.com/talentbridge.bd',
            'youtube_url' => 'https://youtube.com/@talentbridgehrbd',
            
            // Details
            'mission_statement' => 'To transform the recruitment landscape by building meaningful connections between exceptional talent and progressive organizations.',
            'vision_statement' => 'To be the most trusted HR partner in Bangladesh.',
            'company_values' => [
                'Trust & Transparency',
                'Quality Over Quantity',
                'Diversity & Inclusion',
                'Professional Excellence',
                'Long-term Partnerships'
            ],
            'products_services' => 'Executive Search, Permanent Recruitment, HR Outsourcing, Payroll Management, Talent Assessment.',
            'company_history' => [
                ['year' => 2015, 'event' => 'Founded TalentBridge HR Solutions'],
                ['year' => 2017, 'event' => 'IPO listing on Dhaka Stock Exchange'],
                ['year' => 2021, 'event' => 'Launched AI-powered candidate matching platform']
            ],
            'employee_benefits' => [
                'Attractive Salary Package',
                'Health Insurance',
                'Hybrid Work Model',
                'Stock Options',
                'Professional Training',
                'Annual Leave (25 Days)'
            ],
        ]);

        // 3. Add Locations
        EmployerLocation::create([
            'employer_id' => $employer->id,
            'location_name' => 'Corporate HQ',
            'street' => '55 Gulshan Avenue',
            'city' => 'Dhaka',
            'state' => 'Dhaka',
            'zip_code' => '1212',
            'country' => 'Bangladesh',
            'is_primary' => true,
            'display_order' => 1,
        ]);

        EmployerLocation::create([
            'employer_id' => $employer->id,
            'location_name' => 'Chittagong Office',
            'street' => '88 CDA Avenue',
            'city' => 'Chittagong',
            'state' => 'Chittagong',
            'zip_code' => '4220',
            'country' => 'Bangladesh',
            'is_primary' => false,
            'display_order' => 2,
        ]);

        // 4. Add Team Members
        EmployerTeamMember::create([
            'employer_id' => $employer->id,
            'name' => 'Dr. Farhana Sultana',
            'title' => 'Managing Director & CEO',
            'bio' => 'Renowned HR strategist with a PhD in Organizational Behavior.',
            'display_order' => 1,
        ]);

        EmployerTeamMember::create([
            'employer_id' => $employer->id,
            'name' => 'Mohammad Ashraf Khan',
            'title' => 'COO',
            'bio' => '20+ years of operational excellence in HR management.',
            'display_order' => 2,
        ]);
    }
}
