@extends('backend.app')

@section('title', 'Manage Pages - ' . env('APP_NAME'))

@section('content')
<div id="app-content">
    <div class="app-content-area">
        <div class="bg-primary pt-10 pb-21 mt-n6 mx-n4"></div>
        <div class="container-fluid mt-n22 ">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <div class="mb-2 mb-lg-0">
                            <h3 class="mb-0 text-white">CMS Pages Management</h3>
                            <p class="text-white mb-0">Manage all static pages like About Us, Accessibility, etc.</p>
                        </div>
                        <div>
                            <a href="{{ route('admin.pages.create') }}" class="btn btn-white text-primary fw-bold shadow-sm">
                                <i class="bi bi-plus-lg me-1"></i> Add New Page
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-header bg-white border-bottom-0 py-4 d-flex justify-content-between align-items-center">
                            <h4 class="mb-0 fw-bold">All Pages</h4>
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
                                                <h5 class="fw-bold mb-1">{{ $page->title }}</h5>
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
                        <div class="card-footer bg-white mt-2">
                            {{ $pages->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
