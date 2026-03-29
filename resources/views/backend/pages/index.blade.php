@extends('backend.app')

@section('title', 'Manage Pages - ' . config('app.name'))

@section('content')
@include('backend.partials.cms-shell-start')
<div class="row">
    <div class="col-12">
        @include('backend.partials.cms-header', [
            'title' => 'CMS Pages',
            'subtitle' => 'Static pages — About, Accessibility, etc.',
            'actionRoute' => route('admin.pages.create', [], false),
            'actionLabel' => 'Add New Page',
        ])

        <div class="card cms-card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom-0 py-3 d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-bold fs-5">All Pages</h4>
            </div>
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#ID</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Published At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pages as $page)
                        <tr>
                            <td>{{ $page->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($page->featured_image)
                                        <img src="{{ asset('storage/' . $page->featured_image) }}" alt="image" class="avatar avatar-sm rounded-circle me-3">
                                    @else
                                        <div class="icon-shape icon-sm bg-light-primary text-primary rounded-circle me-3">
                                            <i class="bi bi-file-text"></i>
                                        </div>
                                    @endif
                                    <h5 class="fw-bold mb-1 fs-6">{{ $page->title }}</h5>
                                </div>
                            </td>
                            <td><span class="text-muted">{{ $page->slug }}</span></td>
                            <td>
                                @if($page->status === 'published')
                                    <span class="badge bg-light-success text-success rounded-pill px-3">Published</span>
                                @elseif($page->status === 'draft')
                                    <span class="badge bg-light-warning text-warning rounded-pill px-3">Draft</span>
                                @else
                                    <span class="badge bg-light-secondary text-secondary rounded-pill px-3">Archived</span>
                                @endif
                            </td>
                            <td>{{ $page->published_at ? $page->published_at->format('d M, Y') : '-' }}</td>
                            <td>
                                <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-sm btn-outline-primary rounded-pill me-2"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this page?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No pages found. Click 'Add New Page' to create one.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white border-0 py-3">
                {{ $pages->links() }}
            </div>
        </div>
    </div>
</div>
@include('backend.partials.cms-shell-end')
@endsection
