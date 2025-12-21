<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleComment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'article_id',
        'user_id',
        'content',
        'parent_id',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(ArticleComment::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(ArticleComment::class, 'parent_id')->orderBy('created_at', 'asc');
    }

    /**
     * Get commenter name based on user type
     */
    public function getCommenterNameAttribute()
    {
        if ($this->user->isCandidate()) {
            return $this->user->candidate->name ?? 'Unknown';
        } elseif ($this->user->isEmployer()) {
            return $this->user->employer->company_name ?? 'Unknown';
        } elseif ($this->user->isAdmin()) {
            return $this->user->admin->name ?? 'Admin';
        }
        return $this->user->email;
    }

    /**
     * Get commenter initial for avatar
     */
    public function getCommenterInitialAttribute()
    {
        return strtoupper(substr($this->commenter_name, 0, 1));
    }
}
