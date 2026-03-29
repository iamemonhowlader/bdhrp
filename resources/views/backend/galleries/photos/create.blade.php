@extends('backend.app')

@section('title', 'Upload photo — ' . config('app.name'))

@section('content')
@include('backend.partials.cms-shell-start')
<div class="row">
    <div class="col-lg-7">
        @include('backend.partials.cms-header', [
            'title' => 'Upload photo',
            'subtitle' => $gallery->title,
            'backRoute' => route('admin.galleries.photos.index', $gallery),
        ])

        <div class="card cms-card border-0 p-4 p-md-5">
            <form action="{{ route('admin.galleries.photos.store', $gallery) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Image <span class="text-danger">*</span></label>
                    <input type="file" name="image" class="form-control" accept="image/*" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Caption</label>
                    <input type="text" name="caption" class="form-control" value="{{ old('caption') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Group / tab key</label>
                    <input type="text" name="photo_group" class="form-control" value="{{ old('photo_group') }}" placeholder="e.g. donations, member (for frontend filters)">
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Sort order</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0">
                </div>
                <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">Upload</button>
            </form>
        </div>
    </div>
</div>
@include('backend.partials.cms-shell-end')
@endsection
