<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'department',
        'is_active',
        'custom_fields',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'custom_fields' => 'array',
    ];

    /**
     * Get the default fields that are mandatory for all forms
     */
    public static function getDefaultFields()
    {
        return [
            [
                'label' => 'What\'s your name',
                'field_name' => 'applicant_name',
                'type' => 'text',
                'is_required' => true,
                'order' => 0,
            ],
            [
                'label' => 'What\'s your email',
                'field_name' => 'applicant_email',
                'type' => 'text',
                'is_required' => true,
                'order' => 1,
            ],
            [
                'label' => 'Phone number',
                'field_name' => 'applicant_phone',
                'type' => 'text',
                'is_required' => true,
                'order' => 2,
            ],
        ];
    }

    /**
     * Get all fields (default + custom) for this form
     */
    public function getAllFields()
    {
        $defaultFields = self::getDefaultFields();
        $customFields = $this->custom_fields ?? [];

        // Adjust order of custom fields
        foreach ($customFields as $index => &$field) {
            $field['order'] = 3 + $index; // Start after the 3 default fields
        }

        return array_merge($defaultFields, $customFields);
    }

    public function submissions()
    {
        return $this->hasMany(InternshipFormSubmission::class);
    }
}
