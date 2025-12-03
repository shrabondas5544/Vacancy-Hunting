<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateReference extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'name',
        'title',
        'company',
        'email',
        'phone',
        'relationship',
        'display_order',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
