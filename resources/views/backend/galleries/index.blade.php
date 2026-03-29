@extends('backend.app')

@section('title', 'Gallery Albums — ' . config('app.name'))

@section('content')
@include('backend.partials.cms-shell-start')
<div class="row">
    <div class="col-12">
        @include('backend.partials.cms-header', [
            'title' => 'Gallery — Albums',
            'subtitle' => 'Collections of photos for the public site',
            'actionRoute' => route('admin.galleries.create'),
            'actionLabel' => 'New Album',
        ])

        <div class="row g-4">
            @forelse ($galleries as $g)
            <div class="col-md-6 col-xl-4">
                <div class="card cms-card border-0 h-100 shadow-sm overflow-hidden">
                    <div class="ratio ratio-16x9 bg-light">
                        @if($g->cover_image)
                            <img src="{{ asset('storage/'.$g->cover_image) }}" alt="" class="w-100 h-100" style="object-fit:cover">
                        @else
                            <div class="d-flex align-items-center justify-content-center text-muted"><i class="bi bi-images fs-1"></i></div>
                        @endif
                    </div>
                    <div class="card-body">
                        <h5 class="fw-bold mb-1">{{ $g->title }}</h5>
                        <p class="small text-muted mb-2">{{ $g->photos_count }} photos · {{ $g->is_published ? 'Live' : 'Hidden' }}</p>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('admin.galleries.photos.index', $g) }}" class="btn btn-sm btn-primary rounded-pill">Photos</a>
                            <a href="{{ route('admin.galleries.edit', $g) }}" class="btn btn-sm btn-outline-secondary rounded-pill">Edit</a>
                            <form action="{{ route('admin.galleries.destroy', $g) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete album and all photos?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5 text-muted">No albums yet. Create one to upload photos.</div>
            @endforelse
        </div>
        <div class="mt-4">{{ $galleries->links() }}</div>
    </div>
</div>
@include('backend.partials.cms-shell-end')
@endsection
