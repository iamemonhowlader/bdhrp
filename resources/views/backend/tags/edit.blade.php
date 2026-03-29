@extends('backend.app')

@section('title', 'Edit Tag — ' . config('app.name'))

@section('content')
@include('backend.partials.cms-shell-start')
<div class="row">
    <div class="col-lg-8">
        @include('backend.partials.cms-header', [
            'title' => 'Edit Tag',
            'backRoute' => route('admin.tags.index'),
        ])

        <div class="card cms-card border-0 p-4 p-md-5">
            <form action="{{ route('admin.tags.update', $tag) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-bold">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $tag->name) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Slug <span class="text-danger">*</span></label>
                    <input type="text" name="slug" class="form-control" value="{{ old('slug', $tag->slug) }}" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description" class="form-control" rows="2">{{ old('description', $tag->description) }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">Update</button>
            </form>
        </div>
    </div>
</div>
@include('backend.partials.cms-shell-end')
@endsection
