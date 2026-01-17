<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class AdminUser extends Model
{
    protected $fillable = [
        'user_id',
        'email',
        'password',
        'permissions',
        'is_active',
        'is_super_admin',
        'last_login_at',
    ];

    protected $casts = [
        'permissions' => 'array',
        'is_active' => 'boolean',
        'is_super_admin' => 'boolean',
        'last_login_at' => 'datetime',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Check if admin has permission for a specific module
     */
    public function hasPermission($module)
    {
        // Super admin has access to everything
        if ($this->is_super_admin) {
            return true;
        }

        // Check specific permission
        return isset($this->permissions[$module]) && $this->permissions[$module] === true;
    }

    /**
     * Get all available module permissions
     */
    public static function getAvailableModules()
    {
        return [
            'headhunting' => 'Headhunting',
            'corporate_workshop' => 'Corporate Workshop',
            'career_counselling' => 'Career Counselling',
            'skill_development' => 'Skill Development',
            'people_empowerment' => 'People Empowerment',
            'consultancy_advisory' => 'Consultancy & Advisory',
            'campus_bird' => 'Campus Bird Internship',
            'alumni' => 'Create Alumni',
        ];
    }

    /**
     * Scope to get only active admin users
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Update last login timestamp
     */
    public function updateLastLogin()
    {
        $this->update(['last_login_at' => now()]);
    }

    /**
     * Set password with hashing
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
