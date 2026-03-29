@extends('backend.app')

@section('title', 'Edit Page - ' . env('APP_NAME'))

@section('content')
@include('backend.partials.cms-shell-start')
<div class="row">
    <div class="col-12">
        @include('backend.partials.cms-header', [
            'title' => 'Edit CMS Page',
            'subtitle' => 'Update static page content',
            'backRoute' => route('admin.pages.index', [], false),
        ])
        <div class="card cms-card border-0 shadow-sm">
            <div class="card-body p-4 p-lg-5">
                            <form action="{{ route('admin.pages.update', $page) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-8">
                                        <!-- Main Content -->
                                        <div class="mb-4">
                                            <label class="form-label fw-bold">Page Title <span class="text-danger">*</span></label>
                                            <input type="text" name="title" class="form-control" value="{{ old('title', $page->title) }}" required>
                                            @error('title')<div class="validation-error">{{ $message }}</div>@enderror
                                        </div>
                                        
                                        <div class="mb-4">
                                            <label class="form-label fw-bold">Page Slug <span class="text-danger">*</span></label>
                                            <input type="text" name="slug" class="form-control" value="{{ old('slug', $page->slug) }}" required>
                                            <small class="text-muted d-block mt-1">Changing this might break existing links.</small>
                                            @error('slug')<div class="validation-error">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label fw-bold">Page Content</label>
                                            <textarea name="content" class="form-control" rows="10">{{ old('content', $page->content) }}</textarea>
                                            @error('content')<div class="validation-error">{{ $message }}</div>@enderror
                                        </div>

                                        <!-- SEO Settings -->
                                        <div class="card bg-light border-0 shadow-none mt-5">
                                            <div class="card-body">
                                                <h5 class="mb-3"><i class="bi bi-search me-2"></i>SEO Settings</h5>
                                                
                                                <div class="mb-3">
                                                    <label class="form-label text-muted">Meta Title</label>
                                                    <input type="text" name="meta_title" class="form-control form-control-sm" value="{{ old('meta_title', $page->meta_title) }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label text-muted">Meta Description</label>
                                                    <textarea name="meta_description" class="form-control form-control-sm" rows="3">{{ old('meta_description', $page->meta_description) }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <!-- Sidebar Settings -->
                                        <div class="mb-4 p-4 border rounded bg-light">
                                            <label class="form-label fw-bold"><i class="bi bi-gear me-2"></i>Publishing</label>
                                            
                                            <div class="mt-3">
                                                <label class="form-label text-muted">Status <span class="text-danger">*</span></label>
                                                <select name="status" class="form-select" required>
                                                    <option value="draft" {{ old('status', $page->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                                    <option value="published" {{ old('status', $page->status) == 'published' ? 'selected' : '' }}>Published</option>
                                                    <option value="archived" {{ old('status', $page->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                                                </select>
                                                @error('status')<div class="validation-error">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="mt-4">
                                                <label class="form-label text-muted">Page Type</label>
                                                <input type="text" name="page_type" class="form-control form-control-sm" value="{{ old('page_type', $page->page_type) }}">
                                            </div>

                                            <div class="mt-4 pt-3 border-top">
                                                <label class="form-label fw-bold text-dark"><i class="bi bi-list-ul me-1"></i> Site navigation</label>
                                                <div class="form-check mt-2">
                                                    <input class="form-check-input" type="checkbox" name="show_in_nav" value="1" id="show_in_nav" @checked(old('show_in_nav', $page->show_in_nav))>
                                                    <label class="form-check-label" for="show_in_nav">Show in public navbar</label>
                                                </div>
                                                <div class="mt-2">
                                                    <label class="form-label text-muted small">Nav group</label>
                                                    <input type="text" name="nav_group" class="form-control form-control-sm" value="{{ old('nav_group', $page->nav_group) }}">
                                                </div>
                                                <div class="mt-2">
                                                    <label class="form-label text-muted small">Nav label override</label>
                                                    <input type="text" name="nav_label" class="form-control form-control-sm" value="{{ old('nav_label', $page->nav_label) }}">
                                                </div>
                                                <div class="mt-2">
                                                    <label class="form-label text-muted small">Nav order</label>
                                                    <input type="number" name="nav_sort_order" class="form-control form-control-sm" value="{{ old('nav_sort_order', $page->nav_sort_order) }}" min="0">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label fw-bold">Featured Image</label>
                                            @if($page->featured_image)
                                                <div class="mb-3 text-center p-3 border rounded bg-light">
                                                    <img src="{{ asset('storage/' . $page->featured_image) }}" alt="image" class="img-fluid rounded shadow-sm" style="max-height: 150px;">
                                                </div>
                                            @endif
                                            <input type="file" name="featured_image" class="form-control" accept="image/*">
                                            @error('featured_image')<div class="validation-error">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="d-grid mt-5">
                                            <button type="submit" class="btn btn-primary py-2 shadow-sm rounded-pill fw-bold">
                                                <i class="bi bi-cloud-arrow-up me-2"></i> Update Page
                                            </button>
                                        </div>
                                    </div>
                                </div>
            </form>
        </div>
    </div>
</div>
</div>
@include('backend.partials.cms-shell-end')
@endsection
