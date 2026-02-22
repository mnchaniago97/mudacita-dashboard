<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\NewsArticle;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display public news page
     */
    public function publicIndex()
    {
        $appSettings = \App\Models\Setting::first();
        $articles = NewsArticle::with('category')->where('status', 'published')->latest()->paginate(9);
        return view('public.news', compact('appSettings', 'articles'));
    }

    /**
     * Display public news detail page
     */
    public function publicShow($slug)
    {
        $appSettings = \App\Models\Setting::first();
        $article = NewsArticle::with('category')->where('slug', $slug)->firstOrFail();
        
        // Get related articles
        $relatedArticles = NewsArticle::with('category')
            ->where('id', '!=', $article->id)
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();
        
        return view('public.news-detail', compact('appSettings', 'article', 'relatedArticles'));
    }

    /**
     * Display a listing of the articles.
     */
    public function index()
    {
        $articles = NewsArticle::with('category')->latest()->paginate(10);
        return view('admin.pages.news.index', compact('articles'));
    }

    /**
     * Show the form for creating a new article.
     */
    public function create()
    {
        $categories = NewsCategory::active()->get();
        return view('admin.pages.news.create', compact('categories'));
    }

    /**
     * Store a newly created article in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'category_id' => 'nullable|exists:news_categories,id',
            'author_name' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published',
            'is_featured' => 'nullable|boolean',
        ]);

        // Generate slug
        $baseSlug = Str::slug($data['title']);
        $data['slug'] = $this->generateUniqueSlug(NewsArticle::class, $baseSlug);
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news/articles', 'public');
        }

        // Set published_at
        if ($request->status === 'published') {
            $data['published_at'] = now();
        }

        NewsArticle::create($data);

        return redirect()->route('news.index')
            ->with('success', 'Artikel berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified article.
     */
    public function edit(NewsArticle $news)
    {
        $categories = NewsCategory::active()->get();
        return view('admin.pages.news.edit', compact('news', 'categories'));
    }

    /**
     * Update the specified article in storage.
     */
    public function update(Request $request, NewsArticle $news)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'category_id' => 'nullable|exists:news_categories,id',
            'author_name' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published',
            'is_featured' => 'nullable|boolean',
        ]);

        // Generate slug
        $baseSlug = Str::slug($data['title']);
        $data['slug'] = $this->generateUniqueSlug(NewsArticle::class, $baseSlug, $news->id);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $data['image'] = $request->file('image')->store('news/articles', 'public');
        }

        // Set published_at
        if ($request->status === 'published' && !$news->published_at) {
            $data['published_at'] = now();
        }

        $news->update($data);

        return redirect()->route('news.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Remove the specified article from storage.
     */
    public function destroy(NewsArticle $news)
    {
        // Delete image
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()->route('news.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }

    // ========== CATEGORIES ==========

    /**
     * Display a listing of the categories.
     */
    public function categoriesIndex()
    {
        $categories = NewsCategory::latest()->paginate(10);
        return view('admin.pages.news.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function categoriesCreate()
    {
        return view('admin.pages.news.categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function categoriesStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:50',
            'color_custom' => 'nullable|string|max:50',
            'is_active' => 'nullable|boolean',
        ]);

        $baseSlug = Str::slug($data['name']);
        $data['slug'] = $this->generateUniqueSlug(NewsCategory::class, $baseSlug);
        $data['color'] = $request->input('color') ?: $request->input('color_custom') ?: '#08546c';
        $data['is_active'] = $request->has('is_active');
        unset($data['color_custom']);

        NewsCategory::create($data);

        return redirect()->route('news.categories.index')
            ->with('success', 'Kategori berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified category.
     */
    public function categoriesEdit(NewsCategory $category)
    {
        return view('admin.pages.news.categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function categoriesUpdate(Request $request, NewsCategory $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:50',
            'color_custom' => 'nullable|string|max:50',
            'is_active' => 'nullable|boolean',
        ]);

        $baseSlug = Str::slug($data['name']);
        $data['slug'] = $this->generateUniqueSlug(NewsCategory::class, $baseSlug, $category->id);
        $data['color'] = $request->input('color') ?: $request->input('color_custom') ?: $category->color;
        $data['is_active'] = $request->has('is_active');
        unset($data['color_custom']);

        $category->update($data);

        return redirect()->route('news.categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified category from storage.
     */
    public function categoriesDestroy(NewsCategory $category)
    {
        // Check if category has articles
        if ($category->articles()->count() > 0) {
            return redirect()->route('news.categories.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki artikel.');
        }

        $category->delete();

        return redirect()->route('news.categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }

    private function generateUniqueSlug(string $modelClass, string $baseSlug, ?int $ignoreId = null): string
    {
        $slug = $baseSlug;
        $counter = 1;

        while ($modelClass::where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $counter++;
            $slug = $baseSlug . '-' . $counter;
        }

        return $slug;
    }
}
