<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'company_type',
        'contact_number',
        'company_description',
        'establishment_year',
        'company_ownership',
        'employee_count',
        'company_address',
        'street',
        'city',
        'state',
        'zip_code',
        'country',
        'trade_license_no',
        'website_url',
        'linkedin_url',
        'twitter_url',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'mission_statement',
        'vision_statement',
        'company_values',
        'products_services',
        'company_history',
        'employee_benefits',
        'status',
        'approved_at',
        'profile_picture',
        'hero_banner',
    ];

    protected $casts = [
        'company_values' => 'array',
        'company_history' => 'array',
        'employee_benefits' => 'array',
        'approved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function locations()
    {
        return $this->hasMany(EmployerLocation::class)->orderBy('display_order');
    }

    public function teamMembers()
    {
        return $this->hasMany(EmployerTeamMember::class)->orderBy('display_order');
    }

    public function media()
    {
        return $this->hasMany(EmployerMedia::class)->orderBy('display_order');
    }
    
    // Scope to find only approved employers
    public function scopeApproved($query)
    {
        return $this->where('status', 'approved');
    }

    // Calculate profile completion percentage
    public function getProfileCompletionAttribute()
    {
        $fields = [
            'company_name', 'company_type', 'contact_number', 'company_description',
            'establishment_year', 'company_ownership', 'employee_count', 'company_address',
            'website_url', 'mission_statement', 'vision_statement', 'street', 'city', 
            'state', 'zip_code', 'country'
        ];
        
        $filledFields = 0;
        foreach ($fields as $field) {
            if (!empty($this->$field)) {
                $filledFields++;
            }
        }
        
        // Add bonus for relationships
        if ($this->locations()->count() > 0) $filledFields++;
        if ($this->teamMembers()->count() > 0) $filledFields++;
        if ($this->media()->count() > 0) $filledFields++;
        
        $totalFields = count($fields) + 3; // +3 for relationships
        return round(($filledFields / $totalFields) * 100);
    }
}