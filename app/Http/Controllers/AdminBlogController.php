<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminBlogController extends Controller
{
    /**
     * Display the blog dashboard.
     */
    public function dashboard()
    {
        $stats = [
            'total_blogs' => Article::count(),
            'recent_blogs' => Article::where('created_at', '>=', now()->subDays(30))->count(),
        ];
        
        // Get chart data for 12 months
        $chartData = $this->getChartData();
        
        // Get category distribution
        $byCategory = Article::selectRaw('category, COUNT(*) as count')
            ->groupBy('category')
            ->pluck('count', 'category')
            ->toArray();
        
        $stats['by_category'] = $byCategory;

        return view('admin.blog.dashboard', compact('stats', 'chartData'));
    }
    
    /**
     * Get chart data for blog posts in the last 12 months.
     */
    private function getChartData()
    {
        $months = [];
        $blogData = [];

        // Get data for last 12 months
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->format('M Y');
            
            $blogData[] = Article::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        return [
            'labels' => $months,
            'blogs' => $blogData,
        ];
    }

    /**
     * Display the blog list.
     */
    public function index(Request $request)
    {
        $query = Article::with('user');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('email', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        $articles = $query->orderBy('created_at', 'desc')->paginate(15);
        $totalBlogs = Article::count();

        return view('admin.blog.index', compact('articles', 'totalBlogs'));
    }

    /**
     * Delete a blog article.
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        // Delete featured image
        if ($article->featured_image) {
            Storage::disk('public')->delete($article->featured_image);
        }

        // Delete related data
        $article->reactions()->delete();
        $article->comments()->delete();
        $article->delete();

        return redirect()->route('admin.blog.index')->with('status', 'blog-deleted');
    }
}
