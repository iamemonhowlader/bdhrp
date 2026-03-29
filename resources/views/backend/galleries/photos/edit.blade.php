@extends('backend.app')

@section('title', 'Edit photo — ' . config('app.name'))

@section('content')
@include('backend.partials.cms-shell-start')
<div class="row">
    <div class="col-lg-7">
        @include('backend.partials.cms-header', [
            'title' => 'Edit photo',
            'backRoute' => route('admin.galleries.photos.index', $gallery),
        ])

        <div class="card cms-card border-0 p-4 p-md-5">
            <div class="mb-4 text-center">
                <img src="{{ asset('storage/'.$photo->image_path) }}" alt="" class="img-fluid rounded shadow-sm" style="max-height:240px">
            </div>
            <form action="{{ route('admin.galleries.photos.update', [$gallery, $photo]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-bold">Replace image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Caption</label>
                    <input type="text" name="caption" class="form-control" value="{{ old('caption', $photo->caption) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Group / tab key</label>
                    <input type="text" name="photo_group" class="form-control" value="{{ old('photo_group', $photo->photo_group) }}">
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Sort order</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $photo->sort_order) }}" min="0">
                </div>
                <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">Save</button>
            </form>
        </div>
    </div>
</div>
@include('backend.partials.cms-shell-end')
@endsection
