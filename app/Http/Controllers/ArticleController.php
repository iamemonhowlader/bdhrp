<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\Helper;
use Illuminate\Routing\Controller as BaseController;

class ArticleController extends BaseController
{
    public function index()
    {
        $articles = Article::with('author')->orderByDesc('created_at')->paginate(15);
        return view('backend.article.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('backend.article.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:1000',
            'body' => 'required|string',
            'status' => 'required|in:draft,published',
            'is_featured' => 'boolean',
            'featured_image' => 'nullable|image|max:5120',
            'categories' => 'nullable|array',
            'tags' => 'nullable|array',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        $slug = Str::slug($data['title']);
        $originalSlug = $slug;
        $count = 1;
        while (Article::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $data['slug'] = $slug;
        $data['author_id'] = auth()->id();
        $data['published_at'] = $data['status'] === 'published' ? now() : null;
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = Helper::uploadFile($request->file('featured_image'), 'articles');
        }

        $article = Article::create($data);

        if (isset($data['categories'])) {
            $article->categories()->sync($data['categories']);
        }

        if (isset($data['tags'])) {
            $article->tags()->sync($data['tags']);
        }

        return redirect()->route('admin.articles.index')->with('success', 'Article created successfully.');
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('backend.article.edit', compact('article', 'categories', 'tags'));
    }

    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'body' => 'required|string',
            'status' => 'required|in:draft,published',
            'is_featured' => 'boolean',
            'featured_image' => 'nullable|image|max:5120',
            'categories' => 'nullable|array',
            'tags' => 'nullable|array',
        ]);

        $slug = Str::slug($data['title']);
        $originalSlug = $slug;
        $count = 1;
        while (Article::where('slug', $slug)->where('id', '!=', $article->id)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $data['slug'] = $slug;
        
        if ($data['status'] === 'published' && !$article->published_at) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('featured_image')) {
            if ($article->featured_image) {
                Helper::deleteFile($article->featured_image);
            }
            $data['featured_image'] = Helper::uploadFile($request->file('featured_image'), 'articles');
        }

        $article->update($data);

        $article->categories()->sync($request->input('categories', []));
        $article->tags()->sync($request->input('tags', []));

        return redirect()->route('admin.articles.index')->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        if ($article->featured_image) {
            Helper::deleteFile($article->featured_image);
        }
        $article->categories()->detach();
        $article->tags()->detach();
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Article deleted successfully.');
    }
}
