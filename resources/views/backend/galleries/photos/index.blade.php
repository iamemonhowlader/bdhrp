@extends('backend.app')

@section('title', 'Photos — ' . $gallery->title)

@section('content')
@include('backend.partials.cms-shell-start')
<div class="row">
    <div class="col-12">
        @include('backend.partials.cms-header', [
            'title' => 'Photos',
            'subtitle' => $gallery->title,
            'backRoute' => route('admin.galleries.index'),
            'actionRoute' => route('admin.galleries.photos.create', $gallery),
            'actionLabel' => 'Upload photo',
        ])

        <div class="row g-3">
            @forelse ($photos as $photo)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card cms-card border-0 shadow-sm h-100">
                    <div class="ratio ratio-1x1 bg-light">
                        <img src="{{ asset('storage/'.$photo->image_path) }}" alt="" class="w-100 h-100 rounded-top" style="object-fit:cover">
                    </div>
                    <div class="card-body p-2">
                        <p class="small text-truncate mb-1" title="{{ $photo->caption }}">{{ $photo->caption ?: '—' }}</p>
                        @if($photo->photo_group)
                            <span class="badge bg-light text-dark rounded-pill small">{{ $photo->photo_group }}</span>
                        @endif
                        <div class="d-flex gap-1 mt-2">
                            <a href="{{ route('admin.galleries.photos.edit', [$gallery, $photo]) }}" class="btn btn-sm btn-outline-primary rounded-pill flex-grow-1">Edit</a>
                            <form action="{{ route('admin.galleries.photos.destroy', [$gallery, $photo]) }}" method="POST" onsubmit="return confirm('Delete?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-pill" type="submit"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5 text-muted">No photos in this album.</div>
            @endforelse
        </div>
        <div class="mt-4">{{ $photos->links() }}</div>
    </div>
</div>
@include('backend.partials.cms-shell-end')
@endsection
