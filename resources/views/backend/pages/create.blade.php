@extends('backend.app')

@section('title', 'Add New Page - ' . env('APP_NAME'))

@section('content')
<div id="app-content">
    <div class="app-content-area">
        <div class="bg-primary pt-10 pb-21 mt-n6 mx-n4"></div>
        <div class="container-fluid mt-n22 ">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <div class="mb-2 mb-lg-0">
                            <h3 class="mb-0 text-white">Add New CMS Page</h3>
                            <p class="text-white-50 mb-0">Create static pages for the website</p>
                        </div>
                        <div>
                            <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-white text-white btn-sm px-4 rounded-pill shadow-sm">
                                <i class="bi bi-arrow-left me-1"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-body p-5">
                            <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-8">
                                        <!-- Main Content -->
                                        <div class="mb-4">
                                            <label class="form-label fw-bold">Page Title <span class="text-danger">*</span></label>
                                            <input type="text" name="title" class="form-control" placeholder="e.g. About Us" value="{{ old('title') }}" required>
                                            @error('title')<div class="validation-error">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label fw-bold">Page Content</label>
                                            <textarea name="content" class="form-control" rows="10" placeholder="Write your content here...">{{ old('content') }}</textarea>
                                            @error('content')<div class="validation-error">{{ $message }}</div>@enderror
                                        </div>

                                        <!-- SEO Settings -->
                                        <div class="card bg-light border-0 shadow-none mt-5">
                                            <div class="card-body">
                                                <h5 class="mb-3"><i class="bi bi-search me-2"></i>SEO Settings</h5>
                                                
                                                <div class="mb-3">
                                                    <label class="form-label text-muted">Meta Title</label>
                                                    <input type="text" name="meta_title" class="form-control form-control-sm" value="{{ old('meta_title') }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label text-muted">Meta Description</label>
                                                    <textarea name="meta_description" class="form-control form-control-sm" rows="3">{{ old('meta_description') }}</textarea>
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
                                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                                    <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                                                </select>
                                                @error('status')<div class="validation-error">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="mt-4">
                                                <label class="form-label text-muted">Page Type</label>
                                                <input type="text" name="page_type" class="form-control form-control-sm" placeholder="e.g. about-us" value="{{ old('page_type') }}">
                                                <small class="text-muted d-block mt-1">Leave blank for a generic page. Use specific slug map keys to map to special layout.</small>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label fw-bold">Featured Image</label>
                                            <input type="file" name="featured_image" class="form-control" accept="image/*">
                                            @error('featured_image')<div class="validation-error">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="d-grid mt-5">
                                            <button type="submit" class="btn btn-primary py-2 shadow-sm rounded-pill fw-bold">
                                                <i class="bi bi-cloud-arrow-up me-2"></i> Save Page
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
