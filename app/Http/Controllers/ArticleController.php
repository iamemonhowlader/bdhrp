<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends BaseController
{
    public function index(Request $request)
    {
        $query = Article::with(['author', 'categories'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        if ($request->filled('q')) {
            $q = $request->string('q');
            $query->where(function ($qry) use ($q) {
                $qry->where('title', 'like', '%' . $q . '%')
                    ->orWhere('excerpt', 'like', '%' . $q . '%');
            });
        }

        $articles = $query->paginate(12)->withQueryString();

        return view('backend.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('backend.articles.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $this->validatedArticle($request);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        }

        $validated['author_id'] = auth()->id() ?? null;

        if (($validated['status'] ?? '') === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }
        if (($validated['status'] ?? '') !== 'published') {
            $validated['published_at'] = null;
        }

        $article = Article::create($validated);

        $article->categories()->sync($request->input('category_ids', []));
        $article->tags()->sync($request->input('tag_ids', []));

        return redirect()->route('admin.articles.index')->with('t-success', 'Article created.');
    }

    public function edit(Article $article)
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        $article->load(['categories', 'tags']);

        return view('backend.articles.edit', compact('article', 'categories', 'tags'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $this->validatedArticle($request, $article->id);

        if ($request->hasFile('featured_image')) {
            if ($article->featured_image) {
                Storage::disk('public')->delete($article->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        }

        if (($validated['status'] ?? '') === 'published' && !$article->published_at) {
            $validated['published_at'] = $validated['published_at'] ?? now();
        }
        if (($validated['status'] ?? '') !== 'published') {
            $validated['published_at'] = null;
        }

        $article->update($validated);

        $article->categories()->sync($request->input('category_ids', []));
        $article->tags()->sync($request->input('tag_ids', []));

        return redirect()->route('admin.articles.index')->with('t-success', 'Article updated.');
    }

    public function destroy(Article $article)
    {
        if ($article->featured_image) {
            Storage::disk('public')->delete($article->featured_image);
        }

        $article->categories()->detach();
        $article->tags()->detach();
        $article->delete();

        return redirect()->route('admin.articles.index')->with('t-success', 'Article deleted.');
    }

    private function validatedArticle(Request $request, ?int $articleId = null): array
    {
        $slugRule = 'nullable|string|max:255|unique:articles,slug';
        if ($articleId) {
            $slugRule .= ',' . $articleId;
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => $slugRule,
            'excerpt' => 'nullable|string',
            'body' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'is_featured' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:categories,id',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'exists:tags,id',
        ]);

        $validated['slug'] = Str::slug($validated['slug'] ?? $validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        return $validated;
    }
}
