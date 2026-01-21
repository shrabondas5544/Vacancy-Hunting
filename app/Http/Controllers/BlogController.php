<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleReaction;
use App\Models\ArticleComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of articles.
     */
    public function index(Request $request)
    {
        $category = $request->get('category', 'all');
        $search = $request->get('search');
        
        $query = Article::published()
            ->with(['user.candidate', 'user.employer', 'reactions', 'comments']); // Load relationships for search

        // Apply Category Filter
        if ($category !== 'all') {
            $query->where('category', $category);
        }

        // Apply Search Filter
        if ($search) {
            $query->where(function($q) use ($search) {
                // Search in Title
                $q->where('title', 'like', "%{$search}%")
                  // Search in Category
                  ->orWhere('category', 'like', "%{$search}%")
                  // Search in Author Name (Candidate or Employer)
                  ->orWhereHas('user', function($userQ) use ($search) {
                      $userQ->whereHas('candidate', function($candidateQ) use ($search) {
                          $candidateQ->where('name', 'like', "%{$search}%");
                      })
                      ->orWhereHas('employer', function($employerQ) use ($search) {
                          $employerQ->where('company_name', 'like', "%{$search}%");
                      });
                  });
            });
        }
        
        $articles = $query->orderBy('published_at', 'desc')
            ->paginate(9);
        
        return view('blog.index', [
            'articles' => $articles,
            'categories' => Article::$categories,
            'selectedCategory' => $category,
            'search' => $search,
        ]);
    }

    /**
     * Show the form for creating a new article.
     */
    public function create()
    {
        return view('blog.create', [
            'categories' => Article::$categories,
        ]);
    }

    /**
     * Store a newly created article.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:it_software,marketing_sales,finance_banking,education,other',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->only(['title', 'content', 'category']);
        $data['user_id'] = Auth::id();
        $data['status'] = 'published';
        $data['published_at'] = now();

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('blog-images', 'public');
            $data['featured_image'] = $path;
        }

        $article = Article::create($data);

        return redirect()->route('blog.show', $article->slug)
            ->with('success', 'Article published successfully!');
    }

    /**
     * Display the specified article.
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->with(['user', 'reactions', 'comments.user', 'comments.replies.user'])
            ->firstOrFail();

        // Check if article is draft - only owner can view
        if ($article->status === 'draft' && (!Auth::check() || Auth::id() !== $article->user_id)) {
            abort(404);
        }

        $userReaction = null;
        if (Auth::check()) {
            $userReaction = $article->userReaction(Auth::id());
        }

        return view('blog.show', [
            'article' => $article,
            'userReaction' => $userReaction,
        ]);
    }

    /**
     * Remove the specified article.
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        // Only owner can delete
        if (Auth::id() !== $article->user_id) {
            abort(403, 'You can only delete your own articles.');
        }

        // Delete featured image
        if ($article->featured_image) {
            Storage::disk('public')->delete($article->featured_image);
        }

        $article->delete();

        return redirect()->route('blog.index')
            ->with('success', 'Article deleted successfully!');
    }

    /**
     * Toggle reaction on an article.
     */
    public function react(Request $request, $id)
    {
        $request->validate([
            'reaction_type' => 'required|in:like,dislike',
        ]);

        $article = Article::findOrFail($id);
        $existingReaction = ArticleReaction::where('article_id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingReaction) {
            if ($existingReaction->reaction_type === $request->reaction_type) {
                // Remove reaction if same type
                $existingReaction->delete();
                $reacted = false;
            } else {
                // Change reaction type
                $existingReaction->update(['reaction_type' => $request->reaction_type]);
                $reacted = true;
            }
        } else {
            // Create new reaction
            ArticleReaction::create([
                'article_id' => $id,
                'user_id' => Auth::id(),
                'reaction_type' => $request->reaction_type,
            ]);
            $reacted = true;
        }

        // Get updated counts
        $counts = $article->fresh()->reaction_counts;

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'reacted' => $reacted,
                'reaction_type' => $request->reaction_type,
                'counts' => $counts,
            ]);
        }

        return back();
    }

    /**
     * Add a comment to an article.
     */
    public function comment(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:article_comments,id',
        ]);

        $article = Article::findOrFail($id);

        ArticleComment::create([
            'article_id' => $id,
            'user_id' => Auth::id(),
            'content' => $request->content,
            'parent_id' => $request->parent_id,
        ]);

        return back()->with('success', 'Comment added successfully!');
    }

    /**
     * Delete a comment.
     */
    public function deleteComment($id)
    {
        $comment = ArticleComment::findOrFail($id);

        // Only comment owner can delete
        if (Auth::id() !== $comment->user_id) {
            abort(403, 'You can only delete your own comments.');
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted successfully!');
    }

    /**
     * Show user's own articles.
     */
    public function myArticles()
    {
        $articles = Article::where('user_id', Auth::id())
            ->with(['reactions', 'comments'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('blog.my-articles', [
            'articles' => $articles,
        ]);
    }
}
