<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id',
        'media_type',
        'file_path',
        'caption',
        'display_order',
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
}
