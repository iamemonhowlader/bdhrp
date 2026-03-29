@extends('backend.app')

@section('title', 'Edit Category — ' . config('app.name'))

@section('content')
@include('backend.partials.cms-shell-start')
<div class="row">
    <div class="col-lg-8">
        @include('backend.partials.cms-header', [
            'title' => 'Edit Category',
            'subtitle' => $category->name,
            'backRoute' => route('admin.categories.index'),
        ])

        <div class="card cms-card border-0 p-4 p-md-5">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-bold">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Slug <span class="text-danger">*</span></label>
                    <input type="text" name="slug" class="form-control" value="{{ old('slug', $category->slug) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Parent <span class="text-muted fw-normal small">(optional)</span></label>
                    <select name="parent_id" class="form-select">
                        <option value="">— None — (top-level category)</option>
                        @foreach($parents as $p)
                            <option value="{{ $p->id }}" @selected(old('parent_id', $category->parent_id) == $p->id)>{{ $p->name }}</option>
                        @endforeach
                    </select>
                    @if($parents->isEmpty())
                        <div class="form-text rounded-2 bg-light border px-3 py-2 mt-2 small">
                            No other categories are available to use as a parent (excluding this one). Create another category first if you want a hierarchy.
                        </div>
                    @else
                        <div class="form-text text-muted small mt-1">
                            Parent choices are your <strong>other</strong> categories—this one is excluded so it can’t be its own parent.
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Sort order</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $category->sort_order) }}" min="0">
                    </div>
                    <div class="col-md-6 mb-3 d-flex align-items-end">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" @checked(old('is_active', $category->is_active))>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>
                @if($category->featured_image)
                    <div class="mb-2"><img src="{{ asset('storage/'.$category->featured_image) }}" alt="" class="rounded shadow-sm" style="max-height:100px"></div>
                @endif
                <div class="mb-4">
                    <label class="form-label fw-bold">Replace featured image</label>
                    <input type="file" name="featured_image" class="form-control" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">Update</button>
            </form>
        </div>
    </div>
</div>
@include('backend.partials.cms-shell-end')
@endsection
