<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $fillable = [
        'program',
        'category',
        'year',
        'name',
        'dob',
        'address',
        'division',
        'email',
        'phone',
        'school',
        'college',
        'university',
        'facebook',
        'instagram',
        'linkedin',
        'twitter',
        'photo',
        'description',
    ];

    protected $casts = [
        'dob' => 'date',
    ];
}
