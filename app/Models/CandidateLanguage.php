<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateLanguage extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'language',
        'proficiency',
        'display_order',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
