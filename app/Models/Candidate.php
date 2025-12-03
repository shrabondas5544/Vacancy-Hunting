<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'experience_years',
        'skills',
        'interested_in',
        'profile_picture',
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
        'hero_banner',
    ];

    protected $casts = [
        'interested_in' => 'array',
        'date_of_birth' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function education()
    {
        return $this->hasMany(CandidateEducation::class)->orderBy('graduation_year', 'desc');
    }

    public function experience()
    {
        return $this->hasMany(CandidateExperience::class)->orderBy('start_date', 'desc');
    }

    public function certifications()
    {
        return $this->hasMany(CandidateCertification::class)->orderBy('display_order');
    }

    public function portfolio()
    {
        return $this->hasMany(CandidatePortfolio::class)->orderBy('display_order');
    }

    public function languages()
    {
        return $this->hasMany(CandidateLanguage::class)->orderBy('display_order');
    }

    public function references()
    {
        return $this->hasMany(CandidateReference::class)->orderBy('display_order');
    }

    public function getProfileCompletionAttribute()
    {
        $fields = [
            'name', 'professional_summary', 'phone', 'skills',
            'street', 'city', 'state', 'country',
            'linkedin_url', 'github_url'
        ];
        
        $filled = 0;
        foreach ($fields as $field) {
            if (!empty($this->$field)) $filled++;
        }
        
        // Add points for relationships
        if ($this->education()->count() > 0) $filled += 2;
        if ($this->experience()->count() > 0) $filled += 2;
        if ($this->certifications()->count() > 0) $filled++;
        if ($this->portfolio()->count() > 0) $filled++;
        if ($this->languages()->count() > 0) $filled++;
        
        $total = count($fields) + 7; // 10 fields + 7 relationship points
        return round(($filled / $total) * 100);
    }
}