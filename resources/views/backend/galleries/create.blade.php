@extends('backend.app')

@section('title', 'New Album — ' . config('app.name'))

@section('content')
@include('backend.partials.cms-shell-start')
<div class="row">
    <div class="col-lg-8">
        @include('backend.partials.cms-header', [
            'title' => 'New Album',
            'backRoute' => route('admin.galleries.index'),
        ])

        <div class="card cms-card border-0 p-4 p-md-5">
            <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Slug</label>
                    <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
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
                            <input class="form-check-input" type="checkbox" name="is_published" value="1" id="pub" @checked(old('is_published', true))>
                            <label class="form-check-label" for="pub">Published</label>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Cover image</label>
                    <input type="file" name="cover_image" class="form-control" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">Create album</button>
            </form>
        </div>
    </div>
</div>
@include('backend.partials.cms-shell-end')
@endsection
