<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id',
        'location_name',
        'street',
        'city',
        'state',
        'zip_code',
        'country',
        'is_primary',
        'display_order',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
}
