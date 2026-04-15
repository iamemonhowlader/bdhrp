<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\Helper;
use App\Models\Article;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\GalleryPhoto;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\SiteSetting;
use App\Models\Tag;
use App\Models\Video;
use App\Models\District;
use App\Models\Topic;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function hero()
    {
        $slides = SiteSetting::decodeValue('hero_slides', SiteSetting::query()->where('key', 'hero_slides')->value('value'));
        if (! is_array($slides) || empty($slides)) {
            $slides = [];
        }

        return Helper::success(200, null, [
            'kicker' => SiteSetting::query()->where('key', 'hero_kicker')->value('value') ?: 'Start Donating Poor People',
            'title' => SiteSetting::query()->where('key', 'hero_title')->value('value') ?: SiteSetting::query()->where('key', 'hero_line1')->value('value') ?: 'Celebrate',
            'subtitle' => SiteSetting::query()->where('key', 'hero_subtitle')->value('value') ?: SiteSetting::query()->where('key', 'hero_line2')->value('value') ?: 'our everyday essentials',
            'primary_label' => SiteSetting::query()->where('key', 'hero_primary_label')->value('value') ?: 'Discover More',
            'primary_href' => SiteSetting::query()->where('key', 'hero_primary_href')->value('value') ?: '/about-us',
            'secondary_label' => SiteSetting::query()->where('key', 'hero_secondary_label')->value('value') ?: 'Get A Quote',
            'secondary_href' => SiteSetting::query()->where('key', 'hero_secondary_href')->value('value') ?: '/contact',
            'slides' => array_values(array_map(function ($slide) {
                $image = $slide['image'] ?? '';
                if ($image !== '' && !str_starts_with($image, 'http')) {
                    $image = asset('storage/' . ltrim($image, '/'));
                }
                return [
                    'image' => $image,
                    'alt' => $slide['alt'] ?? 'hero-slide',
                ];
            }, $slides)),
        ]);
    }

    public function about()
    {
        $stats = SiteSetting::decodeValue('home_about_stats', SiteSetting::query()->where('key', 'home_about_stats')->value('value'));
        
        return Helper::success(200, null, [
            'title' => SiteSetting::query()->where('key', 'home_about_title')->value('value') ?: 'ABOUT BDHRP',
            'body' => SiteSetting::query()->where('key', 'home_about_body')->value('value') ?: 'Founded in 2007...',
            'more_label' => SiteSetting::query()->where('key', 'home_about_more_label')->value('value') ?: 'more about us',
            'more_href' => SiteSetting::query()->where('key', 'home_about_more_href')->value('value') ?: '/about-us',
            'stats' => is_array($stats) ? $stats : [],
        ]);
    }

    public function bootstrap()
    {
        $settings = SiteSetting::allMapped();

        $menus = [
            'about' => $this->menuPayload('about'),
            'join_us' => $this->menuPayload('join_us'),
            'topics' => $this->dynamicTopics(),
        ];

        $pages = Page::query()->inNavigation()->get();
        $grouped = $pages->groupBy(fn ($p) => $p->nav_group ?: 'default');
        $pageNavigation = [];
        foreach ($grouped as $group => $groupPages) {
            $pageNavigation[$group] = $groupPages->map(function (Page $p) {
                $label = $p->nav_label ?: $p->title;

                return [
                    'label' => $label,
                    'href' => '/'.ltrim($p->slug, '/'),
                    'slug' => $p->slug,
                ];
            })->values()->all();
        }

        $videos = Video::where('status', true)->orderBy('sort_order')->orderByDesc('created_at')->get();

        return Helper::success(200, null, [
            'settings' => $settings,
            'menus' => $menus,
            'page_navigation' => $pageNavigation,
            'videos' => $videos,
        ]);
    }

    public function articles(Request $request)
    {
        $q = Article::query()
            ->with(['categories:id,name,slug', 'tags:id,name,slug'])
            ->published()
            ->orderByDesc('published_at');

        if ($request->boolean('featured')) {
            $q->where('is_featured', true);
        }

        if ($request->filled('category')) {
            $slug = $request->string('category');
            $q->whereHas('categories', fn ($c) => $c->where('slug', $slug));
        }

        $paginator = $q->paginate((int) $request->get('per_page', 12));
        $items = $paginator->getCollection()->map(fn ($a) => $this->transformArticle($a))->values();

        return Helper::success(200, null, [
            'items' => $items,
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
            ],
        ]);
    }

    public function article(string $slug)
    {
        $article = Article::query()
            ->with(['categories:id,name,slug', 'tags:id,name,slug', 'author:id,first_name,last_name'])
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        return Helper::success(200, null, $this->transformArticle($article));
    }

    public function categories()
    {
        $items = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->map(fn ($c) => [
                'id' => $c->id,
                'name' => $c->name,
                'slug' => $c->slug,
                'description' => $c->description,
                'parent_id' => $c->parent_id,
                'featured_image' => $this->storageUrl($c->featured_image),
            ]);

        return Helper::success(200, null, ['items' => $items]);
    }

    public function tags()
    {
        $items = Tag::query()->orderBy('name')->get()->map(fn ($t) => [
            'id' => $t->id,
            'name' => $t->name,
            'slug' => $t->slug,
        ]);

        return Helper::success(200, null, ['items' => $items]);
    }

    public function pages()
    {
        $items = Page::query()
            ->where('status', 'published')
            ->orderBy('title')
            ->get()
            ->map(function ($p) {
                /** @var Page $p */
                return $this->transformPage($p);
            });

        return Helper::success(200, null, ['items' => $items]);
    }

    public function page(string $slug)
    {
        $page = Page::query()
            ->where('status', 'published')
            ->where('slug', $slug)
            ->firstOrFail();

        return Helper::success(200, null, $this->transformPage($page));
    }

    public function navigation()
    {
        $pages = Page::query()
            ->inNavigation()
            ->get();

        $grouped = $pages->groupBy(fn ($p) => $p->nav_group ?: 'default');

        $out = [];
        foreach ($grouped as $group => $groupPages) {
            $out[$group] = $groupPages->map(function (Page $p) {
                $label = $p->nav_label ?: $p->title;

                return [
                    'label' => $label,
                    'href' => '/' . ltrim($p->slug, '/'),
                    'slug' => $p->slug,
                ];
            })->values()->all();
        }

        return Helper::success(200, null, ['groups' => $out]);
    }

    public function galleries()
    {
        $items = Gallery::query()
            ->where('is_published', true)
            ->withCount('photos')
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get()
            ->map(fn ($g) => [
                'id' => $g->id,
                'title' => $g->title,
                'slug' => $g->slug,
                'description' => $g->description,
                'cover_image' => $this->storageUrl($g->cover_image),
                'photos_count' => $g->photos_count,
            ]);

        return Helper::success(200, null, ['items' => $items]);
    }

    public function gallery(string $slug)
    {
        $gallery = Gallery::query()
            ->where('is_published', true)
            ->where('slug', $slug)
            ->with(['photos' => fn ($q) => $q->orderBy('sort_order')])
            ->firstOrFail();

        $photos = $gallery->photos->map(fn ($ph) => [
            'id' => $ph->id,
            'url' => $this->storageUrl($ph->image_path),
            'caption' => $ph->caption,
            'photo_group' => $ph->photo_group,
            'sort_order' => $ph->sort_order,
        ]);

        return Helper::success(200, null, [
            'id' => $gallery->id,
            'title' => $gallery->title,
            'slug' => $gallery->slug,
            'description' => $gallery->description,
            'cover_image' => $this->storageUrl($gallery->cover_image),
            'photos' => $photos,
        ]);
    }

    public function galleryPhotos(Request $request)
    {
        $q = GalleryPhoto::query()
            ->with('gallery:id,title,slug')
            ->whereHas('gallery', fn ($g) => $g->where('is_published', true))
            ->orderBy('sort_order');

        if ($request->filled('group')) {
            $q->where('photo_group', $request->string('group'));
        }

        $paginator = $q->paginate((int) $request->get('per_page', 24));

        $items = $paginator->getCollection()->map(fn ($ph) => [
            'id' => $ph->id,
            'url' => $this->storageUrl($ph->image_path),
            'caption' => $ph->caption,
            'photo_group' => $ph->photo_group,
            'gallery' => $ph->gallery ? [
                'title' => $ph->gallery->title,
                'slug' => $ph->gallery->slug,
            ] : null,
        ]);

        return Helper::success(200, null, [
            'items' => $items,
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
            ],
        ]);
    }

    public function districts()
    {
        $items = District::where('is_active', true)->orderBy('name')->get()->map(fn($d) => [
            'id' => $d->id,
            'name' => $d->name,
            'slug' => $d->slug,
            'division' => $d->division,
        ]);
        return Helper::success(200, null, ['items' => $items]);
    }

    public function district(string $slug)
    {
        $district = District::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return Helper::success(200, null, [
            'id' => $district->id,
            'name' => $district->name,
            'slug' => $district->slug,
            'division' => $district->division,
            'population' => $district->population,
            'area' => $district->area,
            'established' => $district->established,
            'about_short' => $district->about_short,
            'about_body' => $district->about_body,
            'landmarks' => array_map(function($l) {
                $img = $l['image'] ?? '';
                if ($img !== '' && !str_starts_with($img, 'http')) {
                    $img = $this->storageUrl($img);
                }
                return array_merge($l, ['image' => $img]);
            }, is_array($district->landmarks) ? $district->landmarks : []),
        ]);
    }

    public function topics()
    {
        return Helper::success(200, null, ['items' => $this->dynamicTopics()]);
    }

    public function topic(string $slug)
    {
        $topic = Topic::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return Helper::success(200, null, [
            'id' => $topic->id,
            'title' => $topic->title,
            'slug' => $topic->slug,
            'description' => $topic->description,
            'image' => $this->storageUrl($topic->image),
        ]);
    }

    private function dynamicTopics(): array
    {
        return Topic::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get()
            ->map(fn($t) => [
                'id' => $t->id,
                'label' => $t->title,
                'href' => '/topic/' . $t->slug,
                'slug' => $t->slug,
            ])
            ->all();
    }

    private function transformArticle(Article $a): array
    {
        return [
            'id' => $a->id,
            'title' => $a->title,
            'slug' => $a->slug,
            'excerpt' => $a->excerpt,
            'body' => $a->body,
            'featured_image' => $this->storageUrl($a->featured_image),
            'status' => $a->status,
            'published_at' => $a->published_at?->toIso8601String(),
            'is_featured' => $a->is_featured,
            'meta_title' => $a->meta_title,
            'meta_description' => $a->meta_description,
            'categories' => $a->categories->map(fn ($c) => $c->only(['id', 'name', 'slug']))->values(),
            'tags' => $a->tags->map(fn ($t) => $t->only(['id', 'name', 'slug']))->values(),
            'author' => $a->author ? [
                'id' => $a->author->id,
                'name' => trim($a->author->first_name . ' ' . $a->author->last_name) ?: $a->author->email,
            ] : null,
        ];
    }

    private function transformPage(Page $p): array
    {
        return [
            'id' => $p->id,
            'title' => $p->title,
            'slug' => $p->slug,
            'content' => $p->content,
            'meta_title' => $p->meta_title,
            'meta_description' => $p->meta_description,
            'featured_image' => $this->storageUrl($p->featured_image),
            'page_type' => $p->page_type,
            'published_at' => $p->published_at?->toIso8601String(),
            'show_in_nav' => $p->show_in_nav,
            'nav_group' => $p->nav_group,
            'nav_label' => $p->nav_label,
            'nav_sort_order' => $p->nav_sort_order,
        ];
    }

    private function storageUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        return asset('storage/' . ltrim($path, '/'));
    }

    private function menuPayload(string $zone): array
    {
        return MenuItem::query()
            ->zone($zone)
            ->roots()
            ->active()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->map(fn (MenuItem $m) => [
                'id' => $m->id,
                'label' => $m->label,
                'href' => $m->href,
                'action' => $m->action,
            ])
            ->values()
            ->all();
    }
}
