@extends('backend.app')

@section('title', 'Articles — ' . config('app.name'))

@section('content')
@include('backend.partials.cms-shell-start')
<div class="row">
    <div class="col-12">
        @include('backend.partials.cms-header', [
            'title' => 'News & Blog',
            'subtitle' => 'All articles',
            'actionRoute' => route('admin.articles.create'),
            'actionLabel' => 'New Article',
        ])

        <div class="card cms-card border-0 mb-4">
            <div class="card-body py-3">
                <form method="GET" class="row g-2 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label small mb-0 text-muted">Search</label>
                        <input type="text" name="q" class="form-control form-control-sm" value="{{ request('q') }}" placeholder="Title or excerpt">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small mb-0 text-muted">Status</label>
                        <select name="status" class="form-select form-select-sm">
                            <option value="">All</option>
                            <option value="draft" @selected(request('status')==='draft')>Draft</option>
                            <option value="published" @selected(request('status')==='published')>Published</option>
                            <option value="archived" @selected(request('status')==='archived')>Archived</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-sm btn-primary rounded-pill w-100">Filter</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card cms-card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Published</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($articles as $article)
                        <tr>
                            <td>{{ $article->id }}</td>
                            <td>
                                <div class="fw-semibold">{{ $article->title }}</div>
                                <div class="small text-muted">{{ $article->categories->pluck('name')->join(', ') ?: '—' }}</div>
                            </td>
                            <td>
                                @if($article->status === 'published')
                                    <span class="badge bg-light-success text-success rounded-pill px-3">Published</span>
                                @elseif($article->status === 'draft')
                                    <span class="badge bg-light-warning text-warning rounded-pill px-3">Draft</span>
                                @else
                                    <span class="badge bg-light-secondary text-secondary rounded-pill px-3">Archived</span>
                                @endif
                                @if($article->is_featured)
                                    <span class="badge bg-light-primary text-primary rounded-pill px-2 ms-1">Featured</span>
                                @endif
                            </td>
                            <td>{{ $article->published_at?->format('d M Y') ?? '—' }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-sm btn-outline-primary rounded-pill"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this article?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center py-5 text-muted">No articles yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white border-0">{{ $articles->links() }}</div>
        </div>
    </div>
</div>
@include('backend.partials.cms-shell-end')
@endsection
