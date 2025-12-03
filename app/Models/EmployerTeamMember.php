<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerTeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id',
        'name',
        'title',
        'bio',
        'photo',
        'display_order',
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
}
