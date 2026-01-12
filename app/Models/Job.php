<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id',
        'title',
        'description',
        'requirements',
        'field_type',
        'job_type',
        'experience_level',
        'location',
        'division',
        'vacancies',
        'salary_range',
        'deadline',
        'educational_qualifications',
        'experience',
        'required_skills',
        'job_benefits',
        'status',
    ];

    protected $casts = [
        'deadline' => 'date',
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
}
