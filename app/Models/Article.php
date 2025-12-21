<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $table = 'blog_articles';

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'featured_image',
        'category',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Category labels for display
    public static $categories = [
        'it_software' => 'IT/Software',
        'marketing_sales' => 'Marketing/Sales',
        'finance_banking' => 'Finance/Banking',
        'education' => 'Education',
        'other' => 'Other',
    ];

    /**
     * Boot function to auto-generate slug
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
                // Make slug unique
                $count = static::whereRaw("slug LIKE ?", [$article->slug . '%'])->count();
                if ($count > 0) {
                    $article->slug = $article->slug . '-' . ($count + 1);
                }
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reactions()
    {
        return $this->hasMany(ArticleReaction::class);
    }

    public function comments()
    {
        return $this->hasMany(ArticleComment::class)->whereNull('parent_id')->orderBy('created_at', 'desc');
    }

    public function allComments()
    {
        return $this->hasMany(ArticleComment::class)->orderBy('created_at', 'desc');
    }

    /**
     * Get author name based on user type
     */
    public function getAuthorNameAttribute()
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
     * Get author type label
     */
    public function getAuthorTypeAttribute()
    {
        if ($this->user->isCandidate()) {
            return 'Candidate';
        } elseif ($this->user->isEmployer()) {
            return 'Employer';
        } elseif ($this->user->isAdmin()) {
            return 'Admin';
        }
        return 'User';
    }

    /**
     * Get author initial for avatar
     */
    public function getAuthorInitialAttribute()
    {
        return strtoupper(substr($this->author_name, 0, 1));
    }

    /**
     * Get category label
     */
    public function getCategoryLabelAttribute()
    {
        return self::$categories[$this->category] ?? 'Other';
    }

    /**
     * Get excerpt from content
     */
    public function getExcerptAttribute()
    {
        return Str::limit(strip_tags($this->content), 150);
    }

    /**
     * Scope to filter by published status
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')->whereNotNull('published_at');
    }

    /**
     * Scope to filter by category
     */
    public function scopeCategory($query, $category)
    {
        if ($category && $category !== 'all') {
            return $query->where('category', $category);
        }
        return $query;
    }

    /**
     * Check if user has reacted to this article
     */
    public function userReaction($userId)
    {
        return $this->reactions()->where('user_id', $userId)->first();
    }

    /**
     * Get reaction counts by type
     */
    public function getReactionCountsAttribute()
    {
        return $this->reactions()
            ->selectRaw('reaction_type, count(*) as count')
            ->groupBy('reaction_type')
            ->pluck('count', 'reaction_type')
            ->toArray();
    }
}
