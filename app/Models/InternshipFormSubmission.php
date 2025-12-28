<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipFormSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'internship_form_id',
        'applicant_name',
        'applicant_email',
        'applicant_phone',
        'status',
        'form_data',
    ];

    protected $casts = [
        'form_data' => 'array',
    ];

    public function form()
    {
        return $this->belongsTo(InternshipForm::class, 'internship_form_id');
    }
}
