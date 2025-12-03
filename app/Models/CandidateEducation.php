<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateEducation extends Model
{
    use HasFactory;

    protected $table = 'candidate_education';

    protected $fillable = [
        'candidate_id',
        'degree',
        'institution',
        'graduation_year',
        'gpa',
        'description',
        'display_order',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
