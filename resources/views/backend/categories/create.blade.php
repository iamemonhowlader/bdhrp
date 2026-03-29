@extends('backend.app')

@section('title', 'New Category — ' . config('app.name'))

@section('content')
@include('backend.partials.cms-shell-start')
<div class="row">
    <div class="col-lg-8">
        @include('backend.partials.cms-header', [
            'title' => 'New Category',
            'subtitle' => 'Create a taxonomy for articles',
            'backRoute' => route('admin.categories.index'),
        ])

        <div class="card cms-card border-0 p-4 p-md-5">
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Slug</label>
                    <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" placeholder="auto from name">
                    @error('slug')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Parent <span class="text-muted fw-normal small">(optional)</span></label>
                    <select name="parent_id" class="form-select">
                        <option value="">— None — (top-level category)</option>
                        @foreach($parents as $p)
                            <option value="{{ $p->id }}" @selected(old('parent_id') == $p->id)>{{ $p->name }}</option>
                        @endforeach
                    </select>
                    @if($parents->isEmpty())
                        <div class="form-text rounded-2 bg-light border px-3 py-2 mt-2 small">
                            <strong>Where do parents come from?</strong> The list is built from categories you have already saved.
                            Right now you don’t have any—so leave <strong>None</strong>, save this category, then create or edit another category and choose this one as its parent to build a hierarchy (e.g. <em>News</em> → <em>Bangladesh</em>).
                        </div>
                    @else
                        <div class="form-text text-muted small mt-1">
                            Pick another category to nest this one under it. Leave <strong>None</strong> for a top-level category.
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Sort order</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0">
                    </div>
                    <div class="col-md-6 mb-3 d-flex align-items-end">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" @checked(old('is_active', true))>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Featured image</label>
                    <input type="file" name="featured_image" class="form-control" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">Save category</button>
            </form>
        </div>
    </div>
</div>
@include('backend.partials.cms-shell-end')
@endsection
