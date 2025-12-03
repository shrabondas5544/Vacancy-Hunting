<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidatePortfolio extends Model
{
    use HasFactory;

    protected $table = 'candidate_portfolio';

    protected $fillable = [
        'candidate_id',
        'project_name',
        'project_url',
        'description',
        'technologies',
        'thumbnail',
        'display_order',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
