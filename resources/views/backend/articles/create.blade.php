@extends('backend.app')

@section('title', 'New Article — ' . config('app.name'))

@section('content')
@include('backend.partials.cms-shell-start')
<div class="row">
    <div class="col-12">
        @include('backend.partials.cms-header', [
            'title' => 'New Article',
            'subtitle' => 'News or blog post',
            'backRoute' => route('admin.articles.index'),
        ])

        <div class="card cms-card border-0 p-4 p-md-5">
            <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Slug</label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" placeholder="auto from title">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Excerpt</label>
                            <textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Body</label>
                            <textarea name="body" class="form-control" rows="12">{{ old('body') }}</textarea>
                        </div>
                        <div class="card bg-light border-0 mb-3">
                            <div class="card-body">
                                <h6 class="fw-bold mb-2">SEO</h6>
                                <div class="mb-2">
                                    <label class="form-label small text-muted">Meta title</label>
                                    <input type="text" name="meta_title" class="form-control form-control-sm" value="{{ old('meta_title') }}">
                                </div>
                                <div class="mb-0">
                                    <label class="form-label small text-muted">Meta description</label>
                                    <textarea name="meta_description" class="form-control form-control-sm" rows="2">{{ old('meta_description') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="p-4 border rounded-3 bg-light mb-3">
                            <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select" required>
                                <option value="draft" @selected(old('status')==='draft')>Draft</option>
                                <option value="published" @selected(old('status')==='published')>Published</option>
                                <option value="archived" @selected(old('status')==='archived')>Archived</option>
                            </select>
                            <div class="mt-3">
                                <label class="form-label small text-muted">Publish at</label>
                                <input type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at') }}">
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="feat" @checked(old('is_featured'))>
                                <label class="form-check-label" for="feat">Featured</label>
                            </div>
                            <div class="mt-2">
                                <label class="form-label small text-muted">Sort</label>
                                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Categories</label>
                            <select name="category_ids[]" class="form-select" multiple size="6">
                                @foreach($categories as $c)
                                    <option value="{{ $c->id }}" @selected(collect(old('category_ids', []))->contains($c->id))>{{ $c->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">Ctrl/Cmd + click for multiple</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tags</label>
                            <select name="tag_ids[]" class="form-select" multiple size="6">
                                @foreach($tags as $t)
                                    <option value="{{ $t->id }}" @selected(collect(old('tag_ids', []))->contains($t->id))>{{ $t->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Featured image</label>
                            <input type="file" name="featured_image" class="form-control" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-primary rounded-pill w-100 fw-bold py-2">Publish / Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('backend.partials.cms-shell-end')
@endsection
