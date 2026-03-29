@extends('backend.app')

@section('title', 'Edit Album — ' . config('app.name'))

@section('content')
@include('backend.partials.cms-shell-start')
<div class="row">
    <div class="col-lg-8">
        @include('backend.partials.cms-header', [
            'title' => 'Edit Album',
            'subtitle' => $gallery->title,
            'backRoute' => route('admin.galleries.index'),
        ])

        <div class="card cms-card border-0 p-4 p-md-5">
            <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-bold">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $gallery->title) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Slug <span class="text-danger">*</span></label>
                    <input type="text" name="slug" class="form-control" value="{{ old('slug', $gallery->slug) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $gallery->description) }}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Sort order</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $gallery->sort_order) }}" min="0">
                    </div>
                    <div class="col-md-6 mb-3 d-flex align-items-end">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_published" value="1" id="pub" @checked(old('is_published', $gallery->is_published))>
                            <label class="form-check-label" for="pub">Published</label>
                        </div>
                    </div>
                </div>
                @if($gallery->cover_image)
                    <div class="mb-2"><img src="{{ asset('storage/'.$gallery->cover_image) }}" alt="" class="rounded shadow-sm" style="max-height:120px"></div>
                @endif
                <div class="mb-4">
                    <label class="form-label fw-bold">Replace cover</label>
                    <input type="file" name="cover_image" class="form-control" accept="image/*">
                </div>
                <div class="d-flex gap-2 flex-wrap">
                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">Save</button>
                    <a href="{{ route('admin.galleries.photos.index', $gallery) }}" class="btn btn-outline-primary rounded-pill">Manage photos</a>
                </div>
            </form>
        </div>
    </div>
</div>
@include('backend.partials.cms-shell-end')
@endsection
